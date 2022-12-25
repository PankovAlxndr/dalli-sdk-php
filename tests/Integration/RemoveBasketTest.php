<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\OrderResponse;
use DalliSDK\Models\Responses\Error;
use DalliSDK\Models\Responses\Success;
use DalliSDK\Requests\RemoveBasketRequest;
use DalliSDK\Responses\CreateBasketResponse;
use DalliSDK\Responses\RemoveBasketResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class RemoveBasketTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Order/RemoveBasketRequest.xml');
        $request = new RemoveBasketRequest();
        $this->assertSame(RemoveBasketResponse::class, $request->getResponseClass());

        $request->setNumber('100500');
        $request->setBarcode('A1593868');

        $this->assertSame('100500', $request->getNumber());
        $this->assertSame('A1593868', $request->getBarcode());

        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response RemoveBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Order/RemoveBasketResponse.xml'),
            RemoveBasketResponse::class,
            'xml'
        );

        $this->assertSame(1, $response->getRemoved());
    }

    public function testErrorDeSerialization()
    {
        /** @var $response CreateBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Order/CreateBasketErrorResponse.xml'),
            CreateBasketResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(1, $response->getItems());
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(OrderResponse::class, $response->getItems());

        $orderResponse = $response->getItems()[0];
        $this->assertSame('sdk-002', $orderResponse->getNumber());

        $errors = $orderResponse->getErrors();
        $this->assertNotEmpty($response->getItems());
        $this->assertCount(4, $errors);
        $this->assertContainsOnlyInstancesOf(Error::class, $errors);

        $error = $orderResponse->getErrors()[0];
        $this->assertInstanceOf(Error::class, $error);
        $this->assertSame('time_max', $error->getError());
        $this->assertSame(16, $error->getErrorCode());
        $this->assertSame('Некорректно указано максимальное время доставки', $error->getErrorMessage());

        $error = $orderResponse->getErrors()[1];
        $this->assertInstanceOf(Error::class, $error);
        $this->assertSame('interval', $error->getError());
        $this->assertSame(14, $error->getErrorCode());
        $this->assertSame('Некорректно указан временной интервал доставки', $error->getErrorMessage());
    }
}
