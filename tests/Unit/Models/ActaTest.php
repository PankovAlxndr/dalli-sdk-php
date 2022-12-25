<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Acta;
use PHPUnit\Framework\TestCase;

class ActaTest extends TestCase
{
    private Acta $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Acta::create([
            'date' => '2022-12-05',
            'name' => 'База'
        ]);
    }
    public function testGetName()
    {
        $this->assertSame('База', $this->sut->getName());
    }

    public function testGetDate()
    {
        $this->assertSame('2022-12-05', $this->sut->getDate());
    }
}
