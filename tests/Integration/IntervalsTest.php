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
        $request = new IntervalsRequest(1, 11);
        $this->assertSame(IntervalsResponse::class, $request->getResponseClass());

        $this->assertSame(1, $request->getZone());
        $this->assertSame(11, $request->getService());
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
