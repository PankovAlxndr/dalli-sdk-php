<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Filial;
use PHPUnit\Framework\TestCase;

class FilialTest extends TestCase
{
    private Filial $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Filial::create([
            'code' => 1,
            'name' => 'Офис Москва (GMT+3)',
        ]);
    }

    public function testGetCode()
    {
        $this->assertSame(1, $this->sut->getCode());
    }

    public function testGetName()
    {
        $this->assertSame('Офис Москва (GMT+3)', $this->sut->getName());
    }
}
