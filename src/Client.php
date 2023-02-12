<?php

declare(strict_types=1);

namespace DalliSDK;

use DalliSDK\Models\Interval;
use DalliSDK\Models\Order;
use DalliSDK\Models\OrderResponse;
use DalliSDK\Models\Point;
use DalliSDK\Models\Service;
use DalliSDK\Requests\Stickers\StickersBase64Request;
use DalliSDK\Requests\Stickers\StickersStreamRequest;
use DalliSDK\Requests\Stickers\StickersXmlRequest;
use DalliSDK\Responses\Act\ActBase64Response;
use DalliSDK\Responses\Act\TransferMoney\ActTransferMoneyResponse;
use DalliSDK\Responses\Act\TransferReturns\ActTransferReturnResponse;
use DalliSDK\Responses\CreateBasketResponse;
use DalliSDK\Responses\DeliveryCostResponse;
use DalliSDK\Responses\EditBasketResponse;
use DalliSDK\Responses\GetBasketResponse;
use DalliSDK\Responses\IntervalsResponse;
use DalliSDK\Responses\OrderDeliveryStatusResponse;
use DalliSDK\Responses\PointResponse;
use DalliSDK\Responses\RemoveBasketResponse;
use DalliSDK\Responses\RuPostResponse;
use DalliSDK\Responses\SendToDeliveryResponse;
use DalliSDK\Responses\ServicesResponse;
use DalliSDK\Responses\SimpleResponse;
use DalliSDK\Responses\Stickers\StickersBase64Response;
use DalliSDK\Responses\Stickers\StickersXmlResponse;
use JMS\Serializer\Naming\CamelCaseNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * @method ServicesResponse|Service[]               sendServicesRequest(Requests\ServicesRequest $request)
 * @method IntervalsResponse|Interval[]             sendIntervalsRequest(Requests\IntervalsRequest $request)
 * @method PointResponse|Point[]                    sendPointRequest(Requests\PointRequest $request)
 * @method DeliveryCostResponse                     sendDeliveryCostRequest(Requests\DeliveryCostRequest $request)
 * @method OrderDeliveryStatusResponse              sendStatusRequest(Requests\OrderDeliveryStatusRequest $request)
 *
 * @method CreateBasketResponse|OrderResponse[]     sendCreateBasketRequest(Requests\CreateBasketRequest $request)
 * @method RuPostResponse|OrderResponse[]           sendCreateRuPostRequest(Requests\RuPostRequest $request)
 * @method GetBasketResponse|Order[]                sendGetBasketRequest(Requests\GetBasketRequest $request)
 * @method EditBasketResponse|OrderResponse         sendEditBasketRequest(Requests\EditBasketRequest $request)
 * @method RemoveBasketResponse                     sendRemoveBasketRequest(Requests\RemoveBasketRequest $request)
 * @method SendToDeliveryResponse|OrderResponse[]   sendToDeliveryRequest(Requests\SendToDeliveryBasketRequest $request)
 *
 * @method SimpleResponse                           sendStickersStreamRequest(StickersStreamRequest $request)
 * @method StickersBase64Response                   sendStickersBase64Request(StickersBase64Request $request)
 * @method StickersXmlResponse                      sendStickersXmlRequest(StickersXmlRequest $request)
 *
 * @method SimpleResponse                           sendStickersBasketStreamRequest(Requests\Stickers\Basket\StickersStreamRequest $request)
 * @method StickersBase64Response                   sendStickersBasketBase64Request(Requests\Stickers\Basket\StickersBase64Request $request)
 * @method StickersXmlResponse                      sendStickersBasketXmlRequest(Requests\Stickers\Basket\StickersXmlRequest $request)
 *
 * @method SimpleResponse                           sendActStreamRequest(Requests\Act\ActStreamRequest $request)
 * @method ActBase64Response                        sendActBase64Request(Requests\Act\ActBase64Request $request)
 *
 * @method ActTransferMoneyResponse                 sendActTransferMoneyRequest(Requests\Act\TransferMoney\ActTransferMoneyRequest $request)
 * @method ActTransferReturnResponse                sendActTransferReturnRequest(Requests\Act\TransferReturn\ActTransferReturnRequest $request)
 */
class Client
{
    private \Psr\Http\Client\ClientInterface $httpClient;
    private SerializerInterface $serializer;
    private string $token;
    private string $url;

    public function __construct(\Psr\Http\Client\ClientInterface $http, string $token, string $url)
    {
        $this->httpClient = $http;
        $this->token = $token;
        $this->url = $url;

        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new CamelCaseNamingStrategy()))
            ->build();
    }

    public function __call(string $name, array $arguments): \DalliSDK\Responses\ResponseInterface
    {
        if (0 === \strpos($name, 'send')) {
            return $this->sendRequest(...$arguments);
        }
        throw new \BadMethodCallException(\sprintf('Method [%s] not found in [%s].', $name, __CLASS__));
    }


    /**
     * @param \DalliSDK\Requests\RequestInterface $request
     *
     * @return \DalliSDK\Responses\ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function sendRequest(\DalliSDK\Requests\RequestInterface $request): \DalliSDK\Responses\ResponseInterface
    {
        $response = $this->doRequest($request);
        if (
            $response->hasHeader('Content-Type') &&
            \strpos(implode(',', $response->getHeader('Content-Type')), 'text/xml') !== false
        ) {
            $body = $response->getBody()->getContents();
            $body = $this->fixNullAttributes($body);
            $body = $this->fixAmpersand($body);
            return $this->serializer->deserialize($body, $request->getResponseClass(), 'xml');
        } else {
            return new SimpleResponse((string)$response->getBody(), (int)$response->getStatusCode());
        }
    }


    /**
     * @param \DalliSDK\Requests\RequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    private function doRequest(\DalliSDK\Requests\RequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        $request->setAuth($this->token);
        $body = $this->serializer->serialize($request, 'xml');
        return $this->httpClient->sendRequest(new \Nyholm\Psr7\Request('POST', $this->url, [], $body));
    }


    /**
     * В ответе от Dalli отсутствующие значения обязательных аттрибутов почему-то приходят не согласно спецификации xml
     * и поэтому ломается удобная десериализация, чтобы этого не было, фиксим отсутствующие атрибуты
     *
     * @param string $xml
     *
     * @return array|string|string[]|null
     */
    private function fixNullAttributes(string $xml)
    {
        return preg_replace('/([a-zA-Z]+)=""/', 'xsi:$1="nill"', $xml);
    }

    /**
     * Заменям символ амперсанда, так как из-за него ломается десериализация
     *
     * @param string $xml
     *
     * @return array|string|string[]
     */
    private function fixAmpersand(string $xml)
    {
        return str_replace('&', '&amp;', $xml);
    }
}
