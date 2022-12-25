<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\OrderResponse;
use DalliSDK\Models\Responses\Error;
use DalliSDK\Requests\SendToDeliveryBasketRequest;
use DalliSDK\Responses\SendToDeliveryResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class SendToDeliveryTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('SendToDelivery/Request.xml');

        $request = new SendToDeliveryBasketRequest();
        $this->assertSame(SendToDeliveryResponse::class, $request->getResponseClass());

        $request->setBarcodes(['A1593868', 'B1593868', 'C1593868']);
        $this->assertSame($request->getBarcodes(), ['A1593868', 'B1593868', 'C1593868']);

        $this->assertSameXml($xml, $request);
    }

    public function testErrorDeSerialization()
    {
        /** @var $response SendToDeliveryResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('SendToDelivery/Response.xml'),
            SendToDeliveryResponse::class,
            'xml'
        );

        $this->assertSame(4, $response->getCount());

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(4, $response->getItems());
        $this->assertCount(4, $response);
        $this->assertContainsOnlyInstancesOf(OrderResponse::class, $response->getItems());

        $orderResponse = $response->getItems()[0];
        $this->assertSame('4575e966-dcc1-431f-926a-d1a9f86100f1', $orderResponse->getNumber());

        $errors = $orderResponse->getErrors();
        $this->assertNotEmpty($response->getItems());
        $this->assertCount(1, $errors);
        $this->assertContainsOnlyInstancesOf(Error::class, $errors);

        $error = $orderResponse->getErrors()[0];
        $this->assertInstanceOf(Error::class, $error);
        $this->assertSame('items', $error->getError());
        $this->assertSame(26, $error->getErrorCode());
        $this->assertSame('Наложенный платеж не совпадает со стоимостью товарных позиций + стоимость доставки', $error->getErrorMessage());
    }
}
