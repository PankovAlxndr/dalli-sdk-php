<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\StickerOrder;
use PHPUnit\Framework\TestCase;

class StickerOrderTest extends TestCase
{
    private StickerOrder $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = StickerOrder::create([
            'barcode' => 'A1592493',
            'image' => 'image',
            'sender' => 'sender',
            'idIm' => 'idIm',
            'date' => 'date',
            'person' => 'person',
            'address' => 'address'
        ]);
    }

    //string $barcode, string $image, string $sender, string $idIm, string $date, string $person, string $address
    public function testGetIdIm()
    {
        $this->assertSame('idIm', $this->sut->getIdIm());
    }

    public function testGetPerson()
    {
        $this->assertSame('person', $this->sut->getPerson());
    }

    public function testGetDate()
    {
        $this->assertSame('date', $this->sut->getDate());
    }

    public function testGetAddress()
    {
        $this->assertSame('address', $this->sut->getAddress());
    }

    public function testGetSender()
    {
        $this->assertSame('sender', $this->sut->getSender());
    }

    public function testGetBarcode()
    {
        $this->assertSame('A1592493', $this->sut->getBarcode());
    }

    public function testGetImage()
    {
        $this->assertSame('image', $this->sut->getImage());
    }
}
