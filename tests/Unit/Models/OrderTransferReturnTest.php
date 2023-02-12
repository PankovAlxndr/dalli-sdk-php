<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\OrderTransferReturn;
use PHPUnit\Framework\TestCase;

class OrderTransferReturnTest extends TestCase
{
    private OrderTransferReturn $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = OrderTransferReturn::create([
            'aCode' => '6144984',
            'number' => '61339918',
            'barcode' => 'A5428650',
            'deliveredDate' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-12-22 00:00:00'),
            'deliveredTime' => '11:11:00',
            'deliveredTo' => 'по письму им',
            'returnQty' => 1,
            'productName' => 'Документы: Заявление на перенос',
            'governmentCode' => '1-8970109006864173283-3',
            'clientBarCode' => '70109006',
        ]);
    }

    public function testGetDeliveredTo()
    {
        $this->assertSame('по письму им', $this->sut->getDeliveredTo());
    }

    public function testBarcode()
    {
        $this->assertSame('A5428650', $this->sut->getBarcode());
    }

    public function testGetACode()
    {
        $this->assertSame('6144984', $this->sut->getACode());
    }

    public function testGetDeliveredDate()
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-12-22 00:00:00');
        $this->assertEquals($date->getTimestamp(), $this->sut->getDeliveredDate()->getTimestamp());
    }

    public function testGetReturnQty()
    {
        $this->assertSame(1, $this->sut->getReturnQty());
    }

    public function testGetNumber()
    {
        $this->assertSame('61339918', $this->sut->getNumber());
    }

    public function testGetDeliveredTime()
    {
        $this->assertSame('11:11:00', $this->sut->getDeliveredTime());
    }

    public function testGetClientBarCode()
    {
        $this->assertSame('70109006', $this->sut->getClientBarCode());
    }

    public function testGetProductName()
    {
        $this->assertSame('Документы: Заявление на перенос', $this->sut->getProductName());
    }

    public function testGetGovernmentCode()
    {
        $this->assertSame('1-8970109006864173283-3', $this->sut->getGovernmentCode());
    }
}
