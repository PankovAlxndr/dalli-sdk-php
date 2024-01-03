<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Enums\Partner;
use DalliSDK\Models\Point;
use DalliSDK\Requests\PointRequest;
use DalliSDK\Responses\PointResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class PointTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Point/Request.xml');
        $request = new PointRequest();
        $this->assertSame(PointResponse::class, $request->getResponseClass());

        $request->setSettlement('Москва')
            ->setTown('Москва')
            ->setFias('0c5b2444-70a0-4932-980c-b4dc0d3f02b5')
            ->setZipcode('150000')
            ->setPartner(Partner::BOXBERRY);

        $this->assertSame('Москва', $request->getTown());
        $this->assertSame('Москва', $request->getSettlement());
        $this->assertSame('0c5b2444-70a0-4932-980c-b4dc0d3f02b5', $request->getFias());
        $this->assertSame('150000', $request->getZipcode());
        $this->assertSame(Partner::BOXBERRY, $request->getPartner());

        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulSerializationViaPvz()
    {
        $xml = FixturesLoader::load('Point/RequestViaPvz.xml');
        $request = new PointRequest();
        $this->assertSame(PointResponse::class, $request->getResponseClass());

        $request->setPvzcode('99631')
            ->setPartner(Partner::BOXBERRY);

        $this->assertNull($request->getTown());
        $this->assertNull($request->getSettlement());
        $this->assertNull($request->getFias());
        $this->assertNull($request->getZipcode());
        $this->assertSame('99631', $request->getPvzcode());
        $this->assertSame(Partner::BOXBERRY, $request->getPartner());

        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response PointResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Point/SuccessResponse.xml'),
            PointResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(Point::class, $response->getItems());

        $point = $response->getItems()[0];
        $this->assertSame('99631', $point->getCode());
        $this->assertSame('Москва Ремизова_9963_С', $point->getName());
        $this->assertSame('Москва', $point->getSettlement());
        $this->assertSame('Москва', $point->getTown());
        $this->assertSame('0c5b2444-70a0-4932-980c-b4dc0d3f02b5', $point->getFias());
        $this->assertSame('117186, Москва г, Ремизова ул, д.10', $point->getAddress());
        $this->assertSame('Ремизова ул, 10 д', $point->getAddressReduce());
        $this->assertSame('Метро Нагорная.', $point->getDescription());
        $this->assertSame('117186', $point->getZipcode());
        $this->assertSame('0', $point->getOnlyPrepaid());
        $this->assertSame('1', $point->getAcquiring());
        $this->assertSame('1', $point->getCash());
        $this->assertSame('0', $point->getEnableFitting());
        $this->assertSame('пн: 10:00-20:00 вт: 10:00-20:00 ср: 10:00-20:00 чт: 10:00-20:00 пт: 10:00-20:00 сб: 10:00-17:00 вс: 10:00-17:00', $point->getWorkShedule());
        $this->assertSame('55.676220,37.600658', $point->getGPS());
        $this->assertSame('+7(499)391-56-22', $point->getPhone());
        $this->assertSame('BOXBERRY', $point->getPartner());
        $this->assertSame(15.0, $point->getWeightLimit());
        $this->assertSame('Нагорная', $point->getMetro());
        $this->assertSame('Ремизова', $point->getStreet());
        $this->assertSame('10', $point->getHouse());
        $this->assertSame('', $point->getStructure());
        $this->assertSame('', $point->getHousing());
        $this->assertSame('1М', $point->getZone());
        $this->assertSame('0', $point->getPostamat());
        $this->assertSame('2022-12-08 05:43:37', $point->getIdTime());
        $this->assertSame('', $point->getApartment());
    }

    public function testSuccessfulDeSerializationViaPvz()
    {
        /** @var $response PointResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Point/SuccessResponseViaPvz.xml'),
            PointResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(1, $response->getItems());
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(Point::class, $response->getItems());

        $point = $response->getItems()[0];
        $this->assertSame('99631', $point->getCode());
        $this->assertSame('Москва Ремизова_9963_С', $point->getName());
        $this->assertSame('Москва', $point->getSettlement());
        $this->assertSame('Москва', $point->getTown());
        $this->assertSame('0c5b2444-70a0-4932-980c-b4dc0d3f02b5', $point->getFias());
        $this->assertSame('117186, Москва г, Ремизова ул, д.10', $point->getAddress());
        $this->assertSame('Ремизова ул, 10 д', $point->getAddressReduce());
        $this->assertSame('Метро Нагорная.', $point->getDescription());
        $this->assertSame('117186', $point->getZipcode());
        $this->assertSame('0', $point->getOnlyPrepaid());
        $this->assertSame('1', $point->getAcquiring());
        $this->assertSame('1', $point->getCash());
        $this->assertSame('0', $point->getEnableFitting());
        $this->assertSame('пн: 10:00-20:00 вт: 10:00-20:00 ср: 10:00-20:00 чт: 10:00-20:00 пт: 10:00-20:00 сб: 10:00-17:00 вс: 10:00-17:00', $point->getWorkShedule());
        $this->assertSame('55.676220,37.600658', $point->getGPS());
        $this->assertSame('+7(499)391-56-22', $point->getPhone());
        $this->assertSame('BOXBERRY', $point->getPartner());
        $this->assertSame(31.0, $point->getWeightLimit());
        $this->assertSame('Нагорная', $point->getMetro());
        $this->assertSame('Ремизова', $point->getStreet());
        $this->assertSame('10', $point->getHouse());
        $this->assertSame('', $point->getStructure());
        $this->assertSame('', $point->getHousing());
        $this->assertSame('1М', $point->getZone());
        $this->assertSame('0', $point->getPostamat());
        $this->assertSame('2024-01-03 05:43:34', $point->getIdTime());
        $this->assertSame('', $point->getApartment());
    }
}
