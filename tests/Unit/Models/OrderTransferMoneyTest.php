<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\OrderTransferMoney;
use PHPUnit\Framework\TestCase;

class OrderTransferMoneyTest extends TestCase
{
    private OrderTransferMoney $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = OrderTransferMoney::create([
            'strBarCode' => 'A5185814',
            'number' => '61339918',
            'price' => 100.99,
            'deliveredDate' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-12-22 00:00:00'),
            'service' => 55.55,
            'transfer' => 100.10,
        ]);
    }

    public function testGetService()
    {
        $this->assertSame(55.55, $this->sut->getService());
    }

    public function testGetStrBarCode()
    {
        $this->assertSame('A5185814', $this->sut->getStrBarCode());
    }

    public function testGetPrice()
    {
        $this->assertSame(100.99, $this->sut->getPrice());
    }

    public function testGetTransfer()
    {
        $this->assertSame(100.10, $this->sut->getTransfer());
    }

    public function testGetDeliveredDate()
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-12-22 00:00:00');
        $this->assertEquals($date->getTimestamp(), $this->sut->getDeliveredDate()->getTimestamp());
    }

    public function testGetNumber()
    {
        $this->assertSame('61339918', $this->sut->getNumber());
    }
}
