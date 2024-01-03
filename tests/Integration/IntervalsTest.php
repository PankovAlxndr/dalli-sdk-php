<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Interval;
use DalliSDK\Requests\IntervalsRequest;
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
