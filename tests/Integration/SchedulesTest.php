<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Day;
use DalliSDK\Models\Interval;
use DalliSDK\Requests\IntervalsRequest;
use DalliSDK\Requests\SchedulesRequest;
use DalliSDK\Responses\IntervalsResponse;
use DalliSDK\Responses\SchedulesResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class SchedulesTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Schedules/Request.xml');
        $request = new SchedulesRequest(12);
        $this->assertSame(SchedulesResponse::class, $request->getResponseClass());

        $this->assertSame(12, $request->getDaysId());
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulSerializationByFluent()
    {
        $xml = FixturesLoader::load('Schedules/Request.xml');
        $request = new SchedulesRequest();
        $request->setDaysId(12);
        $this->assertSame(SchedulesResponse::class, $request->getResponseClass());

        $this->assertSame(12, $request->getDaysId());
        $this->assertSameXml($xml, $request);
    }



    public function testSuccessfulDeSerialization()
    {
        /** @var $response SchedulesResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Schedules/SuccessResponse.xml'),
            SchedulesResponse::class,
            'xml'
        );

        $this->assertInstanceOf(Day::class, $response->getDays());
        $days =  $response->getDays();
        $this->assertSame(12, $days->getId());
        $this->assertSame('T', $days->getMonday());
        $this->assertSame('T', $days->getTuesday());
        $this->assertSame('T', $days->getWednesday());
        $this->assertSame('T', $days->getThursday());
        $this->assertSame('T', $days->getFriday());
        $this->assertSame('T', $days->getSaturday());
        $this->assertSame('F', $days->getSunday());
    }
}
