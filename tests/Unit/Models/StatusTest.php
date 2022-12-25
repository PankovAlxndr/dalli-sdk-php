<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    private Status $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Status::create([
            'eventtime' => '2020-09-03 17:33:00',
            'createtimegmt' => '2020-09-04 04:13:59',
            'title' => 'Доставлен',
            'code' => 'COMPLETE',


        ]);
    }

    public function testGetTitle()
    {
        $this->assertSame('Доставлен', $this->sut->getTitle());
    }

    public function testGetCode()
    {
        $this->assertSame('COMPLETE', $this->sut->getCode());
    }

    public function testGetEventtime()
    {
        $this->assertSame('2020-09-03 17:33:00', $this->sut->getEventtime());
    }

    public function testGetCreatetimegmt()
    {
        $this->assertSame('2020-09-04 04:13:59', $this->sut->getCreatetimegmt());
    }

    public function testIsNullEventstore()
    {
        $this->assertNull($this->sut->getEventstore());
    }
}
