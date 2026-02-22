<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Ads\Ads;
use DalliSDK\Models\Ads\Climb;
use PHPUnit\Framework\TestCase;

class ClimbTest extends TestCase
{
    private Climb $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Climb::create([
            'floor' => 15,
            'type' => 'elevator',
        ]);
    }

    public function testGetFloor()
    {
        $this->assertSame(15, $this->sut->getFloor());
        $this->assertSame('elevator', $this->sut->getType());
    }

    public function testGetType()
    {
        $this->assertSame('elevator', $this->sut->getType());
    }

    public function testSetFloor()
    {
        $this->sut->setFloor(10);
        $this->assertSame(10, $this->sut->getFloor());
    }

    public function testSetType()
    {
        $this->sut->setType('stairs');
        $this->assertSame('stairs', $this->sut->getType());
    }

    public function testSetNullType()
    {
        $this->sut->setType(null);
        $this->assertNull($this->sut->getType());
    }
}
