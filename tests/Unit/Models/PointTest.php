<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    private Point $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Point::create([
            'code' => 'DS_1',
            'name' => 'ПВЗ Dalli МСК',
            'settlement' => 'Москва',
            'town' => 'Москва',
            'fias' => '0c5b2444-70a0-4932-980c-b4dc0d3f02b5',
            'address' => 'Москва город, Складочная ул., 1, стр 18, подъезд 1',
            'addressReduce' => 'ул Складочная, дом 1, стр 18, подъезд 1',
            'description' => 'От метро Дмитровская серая ветка 1 вагон из центра, после стеклянных дверей налево, по переходу налево.',
            'zipcode' => '127018',
            'onlyPrepaid' => '0',
            'acquiring' => '1',
            'enableFitting' => '1',
            'workShedule' => 'пн-вск 10-22',
            'GPS' => '55.801905, 37.592114',
            'phone' => '+7 (495) 646-86-82',
            'partner' => 'DS',
            'weightLimit' => 25,
            'metro' => 'Дмитровская',
            'street' => 'Складочная ул',
            'zone' => '1М',
            'idTime' => '2022-09-15 13:51:47'
        ]);
    }

    public function testGetName()
    {
        $this->assertSame('ПВЗ Dalli МСК', $this->sut->getName());
    }

    public function testGetCode()
    {
        $this->assertSame('DS_1', $this->sut->getCode());
    }

    public function testGetWorkShedule()
    {
        $this->assertSame('пн-вск 10-22', $this->sut->getWorkShedule());
    }

    public function testGetHouse()
    {
        $this->assertNull($this->sut->getHouse());
    }

    public function testGetAcquiring()
    {
        $this->assertSame('1', $this->sut->getAcquiring());
    }

    public function testGetAddressReduce()
    {
        $this->assertSame('ул Складочная, дом 1, стр 18, подъезд 1', $this->sut->getAddressReduce());
    }

    public function testGetGPS()
    {
        $this->assertSame('55.801905, 37.592114', $this->sut->getGPS());
    }

    public function testGetZipcode()
    {
        $this->assertSame('127018', $this->sut->getZipcode());
    }

    public function testGetPostamat()
    {
        $this->assertNull($this->sut->getPostamat());
    }

    public function testGetDescription()
    {
        $this->assertSame('От метро Дмитровская серая ветка 1 вагон из центра, после стеклянных дверей налево, по переходу налево.', $this->sut->getDescription());
    }

    public function testGetMetro()
    {
        $this->assertSame('Дмитровская', $this->sut->getMetro());
    }

    public function testGetSettlement()
    {
        $this->assertSame('Москва', $this->sut->getSettlement());
    }

    public function testGetOnlyPrepaid()
    {
        $this->assertSame('0', $this->sut->getOnlyPrepaid());
    }

    public function testGetEnableFitting()
    {
        $this->assertSame('1', $this->sut->getEnableFitting());
    }

    public function testGetPhone()
    {
        $this->assertSame('+7 (495) 646-86-82', $this->sut->getPhone());
    }

    public function testGetPartner()
    {
        $this->assertSame('DS', $this->sut->getPartner());
    }

    public function testGetWeightLimit()
    {
        $this->assertSame(25.0, $this->sut->getWeightLimit());
    }

    public function testGetFias()
    {
        $this->assertSame('0c5b2444-70a0-4932-980c-b4dc0d3f02b5', $this->sut->getFias());
    }

    public function testGetZone()
    {
        $this->assertSame('1М', $this->sut->getZone());
    }

    public function testGetTown()
    {
        $this->assertSame('Москва', $this->sut->getTown());
    }

    public function testGetHousing()
    {
        $this->assertNull($this->sut->getHousing());
    }

    public function testGetStreet()
    {
        $this->assertSame('Складочная ул', $this->sut->getStreet());
    }

    public function testGetAddress()
    {
        $this->assertSame('Москва город, Складочная ул., 1, стр 18, подъезд 1', $this->sut->getAddress());
    }

    public function testGetIdTime()
    {
        $this->assertSame('2022-09-15 13:51:47', $this->sut->getIdTime());
    }

    public function testGetStructure()
    {
        $this->assertNull($this->sut->getStructure());
    }

    public function testGetApartment()
    {
        $this->assertNull($this->sut->getApartment());
    }
}
