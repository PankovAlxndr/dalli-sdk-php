<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Receiver;
use PHPUnit\Framework\TestCase;

class ReceiverTest extends TestCase
{
    private Receiver $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Receiver::create([
            'town' => 'Москва город',
            'address' => 'Тестовая улица',
            'pvzcode' => 'RU_630',
            'zipCode' => '150000',
            'person' => 'Тестовый получатель',
            'company' => 'Тестовый получатель',
            'phone' => '+7(000)000-00-00',
            'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00'),
            'timeMin' => '10:00',
            'timeMax' => '22:00',
            'fias' => 'f26b876b-6857-4951-b060-ec6559f04a9a'
        ]);
    }

    public function testGetTown()
    {
        $this->assertSame('Москва город', $this->sut->getTown());
    }

    public function testGetDate()
    {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00');
        $this->assertEquals($dt, $this->sut->getDate());
    }

    public function testGetPvzcode()
    {
        $this->assertSame('RU_630', $this->sut->getPvzcode());
    }

    public function testGetTimeMin()
    {
        $this->assertSame('10:00', $this->sut->getTimeMin());
    }

    public function testGetTimeMax()
    {
        $this->assertSame('22:00', $this->sut->getTimeMax());
    }

    public function testGetAddress()
    {
        $this->assertSame('Тестовая улица', $this->sut->getAddress());
    }

    public function testGetPhone()
    {
        $this->assertSame('+7(000)000-00-00', $this->sut->getPhone());
    }

    public function testGetPerson()
    {
        $this->assertSame('Тестовый получатель', $this->sut->getPerson());
    }

    public function testGetCompany()
    {
        $this->assertSame('Тестовый получатель', $this->sut->getCompany());
    }

    public function testGetZipCode()
    {
        $this->assertSame('150000', $this->sut->getZipCode());
    }

    public function testSetCompany()
    {
        $this->sut->setCompany('Тестовый получатель2');
        $this->assertSame('Тестовый получатель2', $this->sut->getCompany());
    }

    public function testSetPvzCode()
    {
        $this->sut->setPvzcode('RU_999');
        $this->assertSame('RU_999', $this->sut->getPvzcode());
    }

    public function testTo()
    {
        $this->sut->setTo('Москва, Складочная 1 стр 18');
        $this->assertSame('Москва, Складочная 1 стр 18', $this->sut->getTo());
    }

    public function testGetFias()
    {
        $this->assertSame('f26b876b-6857-4951-b060-ec6559f04a9a', $this->sut->getFias());
    }

    public function testSetFias()
    {
        $this->sut->setFias('f26b876b-6857-4951-b060-2312412343');
        $this->assertSame('f26b876b-6857-4951-b060-2312412343', $this->sut->getFias());
    }
}
