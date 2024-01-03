<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Item;
use DalliSDK\Models\Order;
use DalliSDK\Models\Responses\Error;
use DalliSDK\Requests\GetBasketRequest;
use DalliSDK\Responses\GetBasketResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class GetBasketTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('GetBasket/Request.xml');

        $request = new GetBasketRequest();
        $this->assertSame(GetBasketResponse::class, $request->getResponseClass());

        $request->setBarcode('A6000775');
        $request->setNumber('sdk-005');
        $this->assertSame('A6000775', $request->getBarcode());
        $this->assertSame('sdk-005', $request->getNumber());

        $this->assertSameXml($xml, $request);
    }

    public function testErrorDeSerialization()
    {
        /** @var $response GetBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('GetBasket/Response.xml'),
            GetBasketResponse::class,
            'xml'
        );

        $this->assertSame(3, $response->getCount());

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(3, $response->getItems());
        $this->assertCount(3, $response);
        $this->assertContainsOnlyInstancesOf(Order::class, $response->getItems());

        $order = $response->getItems()[0];
        $this->assertInstanceOf(Order::class, $order);

        $this->assertSame('sdk-004', $order->getNumber());
        $this->assertSame('A6000774', $order->getBarcode());

        $item = $order->getItems()[0];
        $this->assertInstanceOf(Item::class, $item);
        $this->assertSame('{"tag1262":"020","tag1263":"14.12.2018","tag1264":"1556","tag1265":"sid=00000000XXXXXX"}', $item->getExtraTags());

        $errors = $order->getErrors();
        $this->assertNotEmpty($response->getItems());
        $this->assertCount(1, $errors);
        $this->assertContainsOnlyInstancesOf(Error::class, $errors);

        $error = $order->getErrors()[0];
        $this->assertSame('items', $error->getError());
        $this->assertSame(26, $error->getErrorCode());
        $this->assertSame('Наложенный платеж не совпадает со стоимостью товарных позиций + стоимость доставки', $error->getErrorMessage());
    }
}
