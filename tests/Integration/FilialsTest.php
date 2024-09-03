<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Filial;
use DalliSDK\Requests\FilialsRequest;
use DalliSDK\Responses\FilialsResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class FilialsTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Filials/Request.xml');
        $request = new FilialsRequest();
        $request->setAuth('my_awesome_token');
        $this->assertSame(FilialsResponse::class, $request->getResponseClass());

        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response FilialsResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Filials/Response.xml'),
            FilialsResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertSame(2, $response->getCount());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(Filial::class, $response->getItems());

        $point = $response->getItems()[0];
        $this->assertSame(1, $point->getCode());
        $this->assertSame('Офис Москва (GMT+3)', $point->getName());
    }
}
