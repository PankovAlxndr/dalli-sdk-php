<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\Filial;
use DalliSDK\Requests\FilialsRequest;
use DalliSDK\Requests\PolygonsRequest;
use DalliSDK\Responses\FilialsResponse;
use DalliSDK\Responses\RawDataResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class PolygonsTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Polygons/Request.xml');
        $request = new PolygonsRequest(22, 0, 91128);

        $this->assertSame(RawDataResponse::class, $request->getResponseClass());
        $this->assertSame(91128, $request->getFilialCode());
        $this->assertSame(0, $request->getZone());
        $this->assertSame(22, $request->getService());

        $this->assertSameXml($xml, $request);
    }
}
