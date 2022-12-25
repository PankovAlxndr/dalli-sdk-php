<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    private Price $sut;
    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Price::create([
            'deliveryPeriod' => '1-2',
            'price' => 100,
            'zone' => '2',
            'service' => 1,
            'msg' => 'Сообщение',
        ]);
    }

    public function testGetDeliveryPeriod()
    {
        $this->assertSame('1-2', $this->sut->getDeliveryPeriod());
    }

    public function testGetPrice()
    {
        $this->assertSame(100, $this->sut->getPrice());
    }

    public function testGetZone()
    {
        $this->assertSame('2', $this->sut->getZone());
    }

    public function testGetService()
    {
        $this->assertSame(1, $this->sut->getService());
    }

    public function testGetMsg()
    {
        $this->assertSame('Сообщение', $this->sut->getMsg());
    }

    public function testAllIsNull()
    {
        $price = new Price();
        $this->assertNull($price->getMsg());
        $this->assertNull($price->getService());
        $this->assertNull($price->getZone());
        $this->assertNull($price->getPrice());
        $this->assertNull($price->getDeliveryPeriod());
    }
}
