<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit;

use DalliSDK\Client;
use DalliSDK\Models\Order;
use DalliSDK\Requests\Act\ActStreamRequest;
use DalliSDK\Requests\GetBasketRequest;
use DalliSDK\Requests\PolygonsRequest;
use DalliSDK\Responses\RawDataResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testExceptionRequest()
    {
        $clientMock = $this->createMock(\Psr\Http\Client\ClientInterface::class);
        $dalli = new Client($clientMock, 'my_token', 'url');

        $this->expectException(\BadMethodCallException::class);
        $dalli->myCustomNonExistentProperty();
    }

    public function testXmlRequest()
    {
        $clientMock = $this->getHttpClient('text/xml', FixturesLoader::load('GetBasket/Response.xml'));

        $dalliClient = new Client($clientMock, 'my_token', 'url');

        $response = $dalliClient->sendGetBasketRequest(new GetBasketRequest());
        $this->assertSame(3, $response->getCount());

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(3, $response->getItems());
        $this->assertCount(3, $response);
        $this->assertContainsOnlyInstancesOf(Order::class, $response->getItems());
    }

    public function testStreamRequest()
    {
        $clientMock = $this->getHttpClient('application/pdf', '%PDF-1.7 3 0 obj ....');

        $dalliClient = new Client($clientMock, 'my_token', 'url');

        $response = $dalliClient->sendActStreamRequest(new ActStreamRequest());

        $this->assertSame('%PDF-1.7 3 0 obj ....', $response->getHttpBody());
    }


    public function testRawRequest()
    {
        $clientMock = $this->getHttpClient('text/xml', FixturesLoader::load('Polygons/Response.json'));

        $dalliClient = new Client($clientMock, 'my_token', 'url');

        $response = $dalliClient->sendPolygonsRequest(new PolygonsRequest(22, 0, 91128));
        $this->assertInstanceOf(RawDataResponse::class, $response);

        $this->assertIsArray($response->getRawData());

        $response->setRawData('test');
        $this->assertSame('test', $response->getRawData());
    }

    private function getHttpClient(string $contentType, string $responseBody, int $statusCode = 200, array $extraHeaders = [])
    {
        $extraHeaders['Content-Type'] = $contentType;

        $response = $this->createMock(\Psr\Http\Message\ResponseInterface::class);

        $response->method('hasHeader')->will($this->returnCallback(function ($headerName) use ($extraHeaders) {
            return \array_key_exists($headerName, $extraHeaders);
        }));

        $response->method('getStatusCode')->willReturn($statusCode);

        $response->method('getHeader')->will($this->returnCallback(function ($headerName) use ($extraHeaders) {
            return [$extraHeaders[$headerName]];
        }));

        $stream = $this->createMock(\Psr\Http\Message\StreamInterface::class);
        $stream->method('__toString')->willReturn($responseBody);
        $stream->method('getContents')->willReturn($responseBody);

        $response->method('getBody')->willReturn($stream);
//        $response->method('getBase64')->willReturn($responseBody);

        $http = $this->createMock(\Psr\Http\Client\ClientInterface::class);

        $http->method('sendRequest')->willReturn($response);


        return $http;
    }
}
