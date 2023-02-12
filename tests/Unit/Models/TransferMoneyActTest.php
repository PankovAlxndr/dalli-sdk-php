<?php

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\OrderTransferMoney;
use DalliSDK\Models\TransferMoneyAct;
use PHPUnit\Framework\TestCase;

class TransferMoneyActTest extends TestCase
{
    private TransferMoneyAct $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = TransferMoneyAct::create([
            'number' => '267870',
            'date' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00'),
            'pay' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2023-01-02 00:00:00'),
            'price' => 100.15,
            'payNo' => 6129,
            'orders' => [
                OrderTransferMoney::create([
                    'strBarCode' => 'A5185814',
                    'number' => '61339918',
                    'deliveredDate' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-12-22 00:00:00'),
                    'service' => 55.55,
                    'transfer' => 100.10,
                ])
            ],
        ]);
    }

    public function testGetOrders()
    {
        $orders = $this->sut->getOrders();
        $this->assertIsArray($orders);
        $this->assertCount(1, $orders);
        $this->assertContainsOnlyInstancesOf(OrderTransferMoney::class, $orders);
    }

    public function testGetNumber()
    {
        $this->assertSame('267870', $this->sut->getNumber());
    }

    public function testGetPay()
    {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-02 00:00:00');
        $this->assertEquals($dt, $this->sut->getPay());
    }

    public function testGetDate()
    {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00');
        $this->assertEquals($dt, $this->sut->getDate());
    }

    public function testGetPayNo()
    {
        $this->assertSame(6129, $this->sut->getPayNo());
    }

    public function testGetPrice()
    {
        $this->assertSame(100.15, $this->sut->getPrice());
    }
}
