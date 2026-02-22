<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Interval;
use DalliSDK\Models\PickupCreate;
use PHPUnit\Framework\TestCase;

class PickupCreateTest extends TestCase
{
    private PickupCreate $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = PickupCreate::create([
            'code' => 1,
            'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-22 00:00:00'),
            'return' => 'YES',
            'instruction' => 'На въезде необходимо предъявить пропуск'
        ]);
    }

    public function testGetCode()
    {
        $this->assertSame(1, $this->sut->getCode());
    }

    public function testGetReturn()
    {
        $this->assertSame('YES', $this->sut->getReturn());
    }

    public function testGetInstruction()
    {
        $this->assertSame('На въезде необходимо предъявить пропуск', $this->sut->getInstruction());
    }

    public function testGetDate()
    {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-22 00:00:00');
        $this->assertEquals($dt, $this->sut->getDate());
    }


    public function testSetCode()
    {
        $this->sut->setCode(22);
        $this->assertSame(22, $this->sut->getCode());
    }

    public function testSetReturn()
    {
        $this->sut->setReturn('NO');
        $this->assertSame('NO', $this->sut->getReturn());
    }

    public function testSetReturnException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->sut->setReturn('FOO');
    }


    public function testSetInstruction()
    {
        $this->sut->setInstruction('На въезде необходимо предъявить пропуск!!!');
        $this->assertSame('На въезде необходимо предъявить пропуск!!!', $this->sut->getInstruction());
    }

    public function testSetDate()
    {
        $this->sut->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-22 00:00:00'));

        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-12-22 00:00:00');
        $this->assertEquals($dt, $this->sut->getDate());
    }
}
