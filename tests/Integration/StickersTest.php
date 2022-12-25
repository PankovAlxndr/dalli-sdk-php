<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Enums\Format;
use DalliSDK\Models\StickerOrder;
use DalliSDK\Requests\Stickers\StickersBase64Request;
use DalliSDK\Requests\Stickers\StickersStreamRequest;
use DalliSDK\Requests\Stickers\StickersXmlRequest;
use DalliSDK\Responses\Stickers\StickersBase64Response;
use DalliSDK\Responses\Stickers\StickersXmlResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class StickersTest extends SerializerTestCase
{
    public function testSuccessfulBase64Serialization()
    {
        $xml = FixturesLoader::load('Stickers/Request.xml');
        $request = new StickersBase64Request(3, ['A5960198', 'A5960199']);
        $this->assertSame(StickersBase64Response::class, $request->getResponseClass());

        $this->assertSame(['A5960198', 'A5960199'], $request->getBarcodes());
        $this->assertSameXml($xml, $request);

        $request->setBarcodes(['A59601981', 'A59601991']);
        $this->assertSame(['A59601981', 'A59601991'], $request->getBarcodes());
        $request->setFormat(Format::A4);
        $this->assertSame(Format::A4, $request->getFormat());
    }

    public function testSuccessfulStreamSerialization()
    {
        $xml = FixturesLoader::load('Stickers/StreamRequest.xml');
        $request = new StickersStreamRequest(2, ['A5960198', 'A5960199']);
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulXmlSerialization()
    {
        $xml = FixturesLoader::load('Stickers/XmlRequest.xml');
        $request = new StickersXmlRequest(3, ['A5960198', 'A5960199']);
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulBase64DeSerialization()
    {
        /** @var $response StickersBase64Response */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Stickers/Base64Response.xml'),
            StickersBase64Response::class,
            'xml'
        );

        $this->assertSame('JVBERi0xLjc.....', $response->getBase64());
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response StickersXmlResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Stickers/Response.xml'),
            StickersXmlResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(10, $response->getItems());
        $this->assertCount(10, $response);
        $this->assertContainsOnlyInstancesOf(StickerOrder::class, $response->getItems());

        $stickerOrder = $response->getItems()[0];
        $this->assertSame('Тверь, бульвар Цанова ул., 6 стр.', $stickerOrder->getAddress());
        $this->assertSame('2022-12-13', $stickerOrder->getDate());
        $this->assertSame('A5971085', $stickerOrder->getBarcode());
        $this->assertSame('https://api.dalli-service.com/v1/barcode/code.php?encoding=code128&code=A5971085', $stickerOrder->getImage());
        $this->assertSame('23867559', $stickerOrder->getIdIm());
        $this->assertSame('ФИО', $stickerOrder->getPerson());
        $this->assertSame('ТЕСТ', $stickerOrder->getSender());

        $stickerOrder = $response->getItems()[1];
        $this->assertSame('', $stickerOrder->getDate());
    }
}
