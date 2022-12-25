<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Requests\Act\ActBase64Request;
use DalliSDK\Requests\Act\ActStreamRequest;
use DalliSDK\Responses\Act\ActBase64Response;
use DalliSDK\Test\Fixtures\FixturesLoader;

class ActTest extends SerializerTestCase
{
    public function testSuccessfulBase64Serialization()
    {
        $xml = FixturesLoader::load('Act/Request.xml');
        $request = new ActBase64Request(['A5960198', 'A5960199']);
        $this->assertSame(ActBase64Response::class, $request->getResponseClass());

        $this->assertSameXml($xml, $request);

        $request->setBarcodes(['A59601981', 'A59601991']);
        $this->assertSame(['A59601981', 'A59601991'], $request->getBarcodes());
    }

    public function testSuccessfulStreamSerialization()
    {
        $xml = FixturesLoader::load('Act/StreamRequest.xml');
        $request = new ActStreamRequest(['A5960198', 'A5960199']);
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulBase64DeSerialization()
    {
        /** @var $response ActBase64Response */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Act/SuccessResponse.xml'),
            ActBase64Response::class,
            'xml'
        );

        $this->assertSame('JVBERi0xLjc.....', $response->getBase64());
    }
}
