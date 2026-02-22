<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\DateIntervals;
use DalliSDK\Models\Interval;
use DalliSDK\Requests\IntervalsRequest;
use DalliSDK\Responses\IntervalsDatesResponse;
use DalliSDK\Responses\IntervalsResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class IntervalsTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Intervals/Request.xml');
        $request = new IntervalsRequest(1, 11, null, null, new \DateTime('2022-12-31 00:00:00'));
        $this->assertSame(IntervalsResponse::class, $request->getResponseClass());

        $this->assertSame(1, $request->getZone());
        $this->assertSame(11, $request->getService());
        $this->assertNull($request->getTown());
        $this->assertNull($request->getFias());
        $this->assertNull($request->getFilial());
        $this->assertNull($request->getAddress());
        $this->assertSame('F', $request->getStrict());
        $this->assertSame('intervals', $request->getOutput());
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-31 00:00:00')->getTimestamp(),
            $request->getDate()->getTimestamp()
        );
        $this->assertSameXml($xml, $request);


        $request->setAddress('foo');
        $request->setZone(12);
        $request->setStrict('F');
        $request->setOutput(IntervalsRequest::OUTPUT_DATES);
        $request->setTown('СПБ');
        $request->setFias('123');
        $request->setService(111);
        $request->setFilial(222);
        $request->setDate(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2026-02-22 00:00:00'));

        $this->assertSame('foo', $request->getAddress());
        $this->assertSame(12, $request->getZone());
        $this->assertSame('F', $request->getStrict());
        $this->assertSame(IntervalsRequest::OUTPUT_DATES, $request->getOutput());
        $this->assertSame('СПБ', $request->getTown());
        $this->assertSame('123', $request->getFias());
        $this->assertSame(111, $request->getService());
        $this->assertSame(222, $request->getFilial());
        $this->assertEquals(
            '2026-02-22',
            $request->getDate()->format('Y-m-d')
        );
    }

    public function testSuccessfulAddressSerialization()
    {
        $xml = FixturesLoader::load('Intervals/AddressRequest.xml');
        $request = new IntervalsRequest(
            null,
            null,
            null,
            null,
            null,
            null,
            'Москва',
            'dates',
            'T'
        );
        $this->assertSame(IntervalsDatesResponse::class, $request->getResponseClass());

        $this->assertNull($request->getZone());
        $this->assertNull($request->getService());
        $this->assertNull($request->getTown());
        $this->assertNull($request->getFias());
        $this->assertNull($request->getFilial());
        $this->assertSame('Москва', $request->getAddress());
        $this->assertSame('T', $request->getStrict());
        $this->assertSame('dates', $request->getOutput());
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulFilialSerialization()
    {
        $xml = FixturesLoader::load('Intervals/RequestFilial.xml');
        $request = new IntervalsRequest(1, 11, null, null, new \DateTime('2022-12-31 00:00:00'), 1);
        $this->assertSame(IntervalsResponse::class, $request->getResponseClass());

        $this->assertSame(1, $request->getZone());
        $this->assertSame(11, $request->getService());
        $this->assertSame(1, $request->getFilial());
        $this->assertNull($request->getTown());
        $this->assertNull($request->getFias());
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-31 00:00:00')->getTimestamp(),
            $request->getDate()->getTimestamp()
        );
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulRegionSerialization()
    {
        $xml = FixturesLoader::load('Intervals/RegionRequest.xml');
        $request = new IntervalsRequest(null, 22, 'воронеж', '5bf5ddff-6353-4a3d-80c4-6fb27f00c6c1', null);
        $this->assertSame(IntervalsResponse::class, $request->getResponseClass());

        $this->assertSame('воронеж', $request->getTown());
        $this->assertSame('5bf5ddff-6353-4a3d-80c4-6fb27f00c6c1', $request->getFias());
        $this->assertSame(22, $request->getService());
        $this->assertNull($request->getZone());
        $this->assertNull($request->getDate());
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response IntervalsResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Intervals/SuccessResponse.xml'),
            IntervalsResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertSame(7, $response->getCount());
        $this->assertCount(7, $response->getItems());
        $this->assertCount(7, $response);
        $this->assertContainsOnlyInstancesOf(Interval::class, $response->getItems());

        $interval = $response->getItems()[0];
        $this->assertSame('9', $interval->getTimeMin());
        $this->assertSame('13', $interval->getTimeMax());
        $this->assertSame('basic', $interval->getType());
        $this->assertSame(1, $interval->getZone());
        $this->assertSame(1, $interval->getService());
    }

    public function testSuccessfulDatesDeSerialization()
    {
        /** @var $response IntervalsDatesResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Intervals/SuccessDatesResponse.xml'),
            IntervalsDatesResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertSame(2, $response->getCount());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(DateIntervals::class, $response->getItems());

        $dateInterval = $response->getItems()[0];
        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2025-10-13 00:00:00');
        $this->assertEquals($date->getTimestamp(), $dateInterval->getValue()->setTime(0, 0)->getTimestamp());

        $intervals = $dateInterval->getIntervals();
        $this->assertNotEmpty($intervals->getItems());
        $this->assertSame(2, $intervals->getCount());
        $this->assertCount(2, $intervals->getItems());
        $this->assertCount(2, $intervals);

        $interval = $intervals->getItems()[0];
        $this->assertContainsOnlyInstancesOf(Interval::class, $intervals->getItems());
        $this->assertSame('basic', $interval->getType());
        $this->assertSame(0, $interval->getZone());
        $this->assertSame(1, $interval->getService());
        $this->assertSame('9', $interval->getTimeMin());
        $this->assertSame('22', $interval->getTimeMax());
    }

    public function testSuccessfulRegionDeSerialization()
    {
        /** @var $response IntervalsResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Intervals/RegionsResponse.xml'),
            IntervalsResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(44, $response->getItems());
        $this->assertCount(44, $response);
        $this->assertContainsOnlyInstancesOf(Interval::class, $response->getItems());

        $interval = $response->getItems()[0];
        $this->assertSame('9', $interval->getTimeMin());
        $this->assertSame('18', $interval->getTimeMax());
        $this->assertSame('basic', $interval->getType());
        $this->assertSame(0, $interval->getZone());
        $this->assertSame(22, $interval->getService());
        $this->assertSame('воронеж', $interval->getTown());
        $this->assertSame('5bf5ddff-6353-4a3d-80c4-6fb27f00c6c1', $interval->getFias());
    }

    public function testEmptyDeSerialization()
    {
        /** @var $response IntervalsResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Intervals/EmptyResponse.xml'),
            IntervalsResponse::class,
            'xml'
        );

        $this->assertEmpty($response->getItems());
        $this->assertCount(0, $response->getItems());
        $this->assertCount(0, $response);
    }

    public function testGetBasicType()
    {
        /** @var $response IntervalsResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Intervals/SuccessResponse.xml'),
            IntervalsResponse::class,
            'xml'
        );
        $arBasic = $response->getBasicType();
        $arClient = $response->getClientType();

        $this->assertCount(6, $arBasic);
        $this->assertCount(1, $arClient);
    }
}
