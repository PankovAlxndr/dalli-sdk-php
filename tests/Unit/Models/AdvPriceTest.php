<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\AdvPrice;
use PHPUnit\Framework\TestCase;

class AdvPriceTest extends TestCase
{
    private AdvPrice $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = AdvPrice::create([
            'code' => 1,
            'price' => 270.0,
            'name' => 'База'
        ]);
    }

    public function testGetPrice()
    {
        $this->assertSame(1, $this->sut->getCode());
    }

    public function testGetCode()
    {
        $this->assertSame(270.0, $this->sut->getPrice());
    }

    public function testGetName()
    {
        $this->assertSame('База', $this->sut->getName());
    }
}
