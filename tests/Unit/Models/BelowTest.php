<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Below;
use PHPUnit\Framework\TestCase;

class BelowTest extends TestCase
{
    private Below $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Below::create([
            'belowSum' => 100.0,
            'price' => 200.0,
        ]);
    }

    public function testGetPrice()
    {
        $this->assertSame(200.0, $this->sut->getPrice());
    }

    public function testGetBelowSum()
    {
        $this->assertSame(100.0, $this->sut->getBelowSum());
    }

    public function testSetPrice()
    {
        $this->sut->setPrice(555.0);
        $this->assertSame(555.0, $this->sut->getPrice());
    }

    public function testSetBelowSum()
    {
        $this->sut->setBelowSum(666.0);
        $this->assertSame(666.0, $this->sut->getBelowSum());
    }
}
