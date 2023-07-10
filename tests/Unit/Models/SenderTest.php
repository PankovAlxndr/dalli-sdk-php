<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Sender;
use PHPUnit\Framework\TestCase;

class SenderTest extends TestCase
{
    private Sender $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Sender::create([
            'company' => 'Тестовый получатель',
            'town' => 'Москва город',
            'address' => 'Тестовая улица',
            'person' => 'Тестовый получатель',
            'phone' => '+7(000)000-00-00',
        ]);
    }

    public function testGetCompany()
    {
        $this->assertSame('Тестовый получатель', $this->sut->getCompany());
    }

    public function testGetTown()
    {
        $this->assertSame('Москва город', $this->sut->getTown());
    }

    public function testGetAddress()
    {
        $this->assertSame('Тестовая улица', $this->sut->getAddress());
    }

    public function testGetPerson()
    {
        $this->assertSame('Тестовый получатель', $this->sut->getPerson());
    }

    public function testGetPhone()
    {
        $this->assertSame('+7(000)000-00-00', $this->sut->getPhone());
    }
}
