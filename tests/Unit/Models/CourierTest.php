<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Courier;
use PHPUnit\Framework\TestCase;

class CourierTest extends TestCase
{
    private Courier $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Courier::create([
            'code' => '1',
            'phone' => '+70000000000',
            'name' => 'Константин Константинопольский'
        ]);
    }

    public function testGetName()
    {
        $this->assertSame('1', $this->sut->getCode());
    }

    public function testGetCode()
    {
        $this->assertSame('+70000000000', $this->sut->getPhone());
    }

    public function testGetPhone()
    {
        $this->assertSame('Константин Константинопольский', $this->sut->getName());
    }
}
