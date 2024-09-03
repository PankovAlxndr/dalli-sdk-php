<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Responses\Response;
use DalliSDK\Requests\CancelOrderRequest;
use DalliSDK\Responses\CancelOrderResponse;
use DalliSDK\Responses\SendToDeliveryResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class CancelOrderTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('CancelOrder/Request.xml');

        $request = new CancelOrderRequest();
        $this->assertSame(CancelOrderResponse::class, $request->getResponseClass());

        $request->setBarcodes(['A5741951', 'A5741952']);
        $this->assertSame($request->getBarcodes(), ['A5741951', 'A5741952']);

        $this->assertSameXml($xml, $request);
    }

    public function testErrorDeSerialization()
    {
        /** @var $response SendToDeliveryResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('CancelOrder/Response.xml'),
            CancelOrderResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(Response::class, $response->getItems());

        $itemSuccess = $response->getItems()[0];
        $this->assertSame('A5741951', $itemSuccess->getBarcode());
        $this->assertSame('Заявка отменена', $itemSuccess->getMessage());
        $this->assertFalse($itemSuccess->getError());

        $itemError = $response->getItems()[1];
        $this->assertSame('A5741952', $itemError->getBarcode());
        $this->assertSame('Заявка не найдена или её уже нельзя отменить', $itemError->getMessage());
        $this->assertTrue($itemError->getError());

    }
}
