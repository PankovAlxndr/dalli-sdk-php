<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\OrderTransferReturn;
use DalliSDK\Models\TransferReturnAct;
use PHPUnit\Framework\TestCase;

class TransferReturnActTest extends TestCase
{
    private TransferReturnAct $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = TransferReturnAct::create([
            'number' => '267870',
            'actDate' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00'),
            'actMessage' => 'Место для вашей рекламы :)',
            'orders' => [
                OrderTransferReturn::create([
                    'aCode' => 'A5185814',
                    'number' => '61339918',
                    'barcode' => 'A5428650',
                    'deliveredDate' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-12-22 00:00:00'),
                    'deliveredTime' => '11:11:00',
                    'deliveredTo' => 'по письму им',
                    'returnQty' => 1,
                    'productName' => 'Документы: Заявление на перенос',
                    'governmentCode' => '1-8970109006864173283-3',
                    'clientBarCode' => '70109006',
                ])
            ],
        ]);
    }

    public function testGetNumber()
    {
        $this->assertSame('267870', $this->sut->getNumber());
    }

    public function testGetDate()
    {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00');
        $this->assertEquals($dt, $this->sut->geActDate());
    }

    public function testGetMessage()
    {
        $this->assertEquals('Место для вашей рекламы :)', $this->sut->getActMessage());
    }

    public function testGetOrders()
    {
        $orders = $this->sut->getOrders();
        $this->assertIsArray($orders);
        $this->assertCount(1, $orders);
        $this->assertContainsOnlyInstancesOf(OrderTransferReturn::class, $orders);
    }
}
