<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Interval;
use PHPUnit\Framework\TestCase;

class IntervalTest extends TestCase
{
    private Interval $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Interval::create([
            'zone' => 1,
            'type' => 'basic',
            'timeMin' => '10',
            'timeMax' => '17',
            'town' => 'белгород',
            'fias' => '02e9c019-ab4d-4fa0-928e-d6c0a41dc256'
        ]);
    }

    public function testGetType()
    {
        $this->assertSame('basic', $this->sut->getType());
    }

    public function testGetZone()
    {
        $this->assertSame(1, $this->sut->getZone());
    }

    public function testGetTimeMin()
    {
        $this->assertSame('10', $this->sut->getTimeMin());
    }

    public function testGetTimeMax()
    {
        $this->assertSame('17', $this->sut->getTimeMax());
    }

    public function testGetTown()
    {
        $this->assertSame('белгород', $this->sut->getTown());
    }

    public function testGetFias()
    {
        $this->assertSame('02e9c019-ab4d-4fa0-928e-d6c0a41dc256', $this->sut->getFias());
    }
}
