<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Address;
use DalliSDK\Models\Code;
use DalliSDK\Models\Day;
use DalliSDK\Requests\GetPickupAddressesRequest;
use DalliSDK\Requests\SchedulesRequest;
use DalliSDK\Responses\GetPickupAddressesResponse;
use DalliSDK\Responses\SchedulesResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class GetPickupAddressesTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('GetPickupAddresses/Request.xml');
        $request = new GetPickupAddressesRequest();
        $request->setCodes([123,1234]);
        $this->assertSame(GetPickupAddressesResponse::class, $request->getResponseClass());

        $this->assertCount(2, $request->getCodes());
        $this->assertSameXml($xml, $request);
    }



    public function testSuccessfulSerializationFluent()
    {
        $xml = FixturesLoader::load('GetPickupAddresses/Request.xml');
        $request = new GetPickupAddressesRequest();
        $request->addCode(123)
            ->addCode(1234);
        $this->assertSame(GetPickupAddressesResponse::class, $request->getResponseClass());

        $this->assertCount(2, $request->getCodes());
        $this->assertSameXml($xml, $request);
    }


    public function testSuccessfulDeSerialization()
    {
        /** @var $response GetPickupAddressesResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('GetPickupAddresses/SuccessResponse.xml'),
            GetPickupAddressesResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertSame(2, $response->getCount());
        $this->assertContainsOnlyInstancesOf(Address::class, $response->getItems());

        $interval = $response->getItems()[0];
        $this->assertSame(123, $interval->getCode());
        $this->assertSame(0, $interval->getActive());
        $this->assertSame('Москва, Тверская, 7', $interval->getAddress());
        $this->assertSame('21:00', $interval->getTimeMin());
        $this->assertSame('22:00', $interval->getTimeMax());
        $this->assertSame('89178365783', $interval->getPhone());
    }
}
