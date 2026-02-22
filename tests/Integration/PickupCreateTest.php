<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\PickupCreate;
use DalliSDK\Requests\PickupCreateRequest;
use DalliSDK\Responses\PickupCreateResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class PickupCreateTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('PickupCreate/Request.xml');
        $request = new PickupCreateRequest();
        $this->assertSame(PickupCreateResponse::class, $request->getResponseClass());

        $request->setPickups([
            new PickupCreate([
                'code' =>  123,
                'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-22 00:00:00'),
                'return' => 'YES',
                'instruction' =>  'На въезде необходимо предъявить пропуск',
            ]),
            new PickupCreate([
                'code' =>  1234,
                'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-23 00:00:00'),
                'return' => 'NO',
                'instruction' => 'Оранжевая вывеска "Корпорация праздник"',
            ]),
        ]);


        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulSerializationFluent()
    {
        $xml = FixturesLoader::load('PickupCreate/Request.xml');
        $request = new PickupCreateRequest();
        $this->assertSame(PickupCreateResponse::class, $request->getResponseClass());
        $request->addPickup(
            new PickupCreate([
                'code' =>  123,
                'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-22 00:00:00'),
                'return' => 'YES',
                'instruction' =>  'На въезде необходимо предъявить пропуск',
            ]),
        )->addPickup(
            new PickupCreate([
                'code' =>  1234,
                'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-23 00:00:00'),
                'return' => 'NO',
                'instruction' => 'Оранжевая вывеска "Корпорация праздник"',
            ]),
        );

        $this->assertNotEmpty($request->getPickups());
        $this->assertCount(2, $request->getPickups());
        $this->assertContainsOnlyInstancesOf(PickupCreate::class, $request->getPickups());

        $this->assertSameXml($xml, $request);
    }




    public function testSuccessfulDeSerialization()
    {
        /** @var $response PickupCreateResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('PickupCreate/SuccessResponse.xml'),
            PickupCreateResponse::class,
            'xml'
        );


        $this->assertNotEmpty($response->getItems());
        $this->assertCount(3, $response->getItems());
        $this->assertCount(3, $response);
        $this->assertContainsOnlyInstancesOf(\DalliSDK\Models\PickupCreateResponse::class, $response->getItems());


        $pickup1 = $response->getItems()[0];
        $this->assertSame(123, $pickup1->getCode());
        $this->assertEmpty($pickup1->getErrors());
        $this->assertCount(2, $pickup1->getSuccess());
        $success1 = $pickup1->getSuccess()[0];
        $this->assertSame('T7754280', $success1->getBarcode());
        $this->assertSame(5, $success1->getService());


        $pickup2 = $response->getItems()[1];
        $this->assertSame(1234, $pickup2->getCode());
        $this->assertEmpty($pickup2->getErrors());
        $this->assertCount(1, $pickup2->getSuccess());

        $pickup3 = $response->getItems()[2];
        $this->assertSame(12345, $pickup3->getCode());
        $this->assertEmpty($pickup3->getSuccess());
        $this->assertCount(1, $pickup3->getErrors());
        $error1 = $pickup3->getErrors()[0];
        $this->assertSame(4, $error1->getErrorCode());
        $this->assertSame('оформление недоступно', $error1->getErrorMessage());
        $this->assertNull($error1->getError());
    }
}
