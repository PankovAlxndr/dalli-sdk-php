<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\PackageDeliveryCost;
use PHPUnit\Framework\TestCase;

class PackageDeliveryCostTest extends TestCase
{
    private PackageDeliveryCost $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = PackageDeliveryCost::create([
            'weight' => 10,
            'length' => 11,
            'width' => 12,
            'height' => 13
        ]);
    }

    public function testGetWeight()
    {
        $this->assertSame(10.0, $this->sut->getWeight());
    }

    public function testGetLength()
    {
        $this->assertSame(11.0, $this->sut->getLength());
    }

    public function testGetWidth()
    {
        $this->assertSame(12.0, $this->sut->getWidth());
    }

    public function testGetHeight()
    {
        $this->assertSame(13.0, $this->sut->getHeight());
    }

    public function testSetWeight()
    {
        $this->sut->setWeight(20);
        $this->assertSame(20.0, $this->sut->getWeight());
    }

    public function testSetLength()
    {
        $this->sut->setLength(30);
        $this->assertSame(30.0, $this->sut->getLength());
    }

    public function testSetWidth()
    {
        $this->sut->setWidth(40);
        $this->assertSame(40.0, $this->sut->getWidth());
    }

    public function testSetHeight()
    {
        $this->sut->setHeight(50);
        $this->assertSame(50.0, $this->sut->getHeight());
    }
}
