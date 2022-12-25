<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Package;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    private Package $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Package::create([
            'strBarCode' => 'A1594134',
            'mass' => 100.0,
            'length' => 200.0,
            'width' => 300.0,
            'height' => 400.0,
            'message' => 'Корневой контейнер',
        ]);
    }
    public function testGetWidth()
    {
        $this->assertSame(300.0, $this->sut->getWidth());
    }

    public function testGetMessage()
    {
        $this->assertSame('Корневой контейнер', $this->sut->getMessage());
    }

    public function testGetLength()
    {
        $this->assertSame(200.0, $this->sut->getLength());
    }

    public function testGetStrBarCode()
    {
        $this->assertSame('A1594134', $this->sut->getStrBarCode());
    }

    public function testGetMass()
    {
        $this->assertSame(100.0, $this->sut->getMass());
    }

    public function testGetHeight()
    {
        $this->assertSame(400.0, $this->sut->getHeight());
    }
}
