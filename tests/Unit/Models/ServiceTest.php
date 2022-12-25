<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    private Service $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Service::create([
            'code' => 2,
            'name' => 'Экспресс МСК',
        ]);
    }

    public function testGetCode()
    {
        $this->assertSame(2, $this->sut->getCode());
    }

    public function testGetName()
    {
        $this->assertSame('Экспресс МСК', $this->sut->getName());
    }
}
