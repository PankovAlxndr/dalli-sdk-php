<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Service;
use DalliSDK\Requests\ServicesRequest;
use DalliSDK\Responses\ServicesResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class ServicesTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Services/Request.xml');
        $request = new ServicesRequest();
        $this->assertSame(ServicesResponse::class, $request->getResponseClass());

        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response ServicesResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Services/SuccessResponse.xml'),
            ServicesResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(21, $response->getItems());
        $this->assertCount(21, $response);
        $this->assertContainsOnlyInstancesOf(Service::class, $response->getItems());

        $service = $response->getItems()[0];
        $this->assertSame('Обычная МСК и МО', $service->getName());
        $this->assertSame(1, $service->getCode());
    }

    public function testFilter()
    {
        /** @var $response ServicesResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Services/SuccessResponse.xml'),
            ServicesResponse::class,
            'xml'
        );

        $service = $response->filterByServiceCode(7);

        $this->assertSame('Возврат товара', $service->getName());
        $this->assertSame(7, $service->getCode());


        $service = $response->filterByServiceCode(999);

        $this->assertFalse($service);
    }
}
