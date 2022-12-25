<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Below;
use DalliSDK\Models\DeliverySet;
use PHPUnit\Framework\TestCase;

class DeliverySetTest extends TestCase
{
    private DeliverySet $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = DeliverySet::create([
            'abovePrice' => 100.0,
            'returnPrice' => 200.0,
            'vatRate' => 20,
            'belows' => [
                Below::create([
                    'belowSum' => 300.0,
                    'price' => 400.0,
                ]),
                Below::create([
                    'belowSum' => 500.0,
                    'price' => 600.0,
                ])
            ]
        ]);
    }

    public function testGetReturnPrice()
    {
        $this->assertSame(200.0, $this->sut->getReturnPrice());
    }

    public function testGetAbovePrice()
    {
        $this->assertSame(100.0, $this->sut->getAbovePrice());
    }

    public function testGetVatRate()
    {
        $this->assertSame(20, $this->sut->getVatRate());
    }

    public function testGetBelows()
    {
        $arBelows = $this->sut->getBelows();
        $this->assertIsArray($arBelows);
        $this->assertCount(2, $arBelows);
        $this->assertContainsOnlyInstancesOf(Below::class, $arBelows);
    }

    public function testSetVatRate()
    {
        $this->sut->setVatRate(10);
        $this->assertSame(10, $this->sut->getVatRate());
    }

    public function testSetNullVatRate()
    {
        $this->sut->setVatRate(null);
        $this->assertNull($this->sut->getVatRate());
    }

    public function testSetBelows()
    {
        $this->sut->setBelows([
            new Below(['belowSum' => 500.0, 'price' => 400.0]),
            new Below(['belowSum' => 2000.0, 'price' => 300.0]),
            new Below(['belowSum' => 5000.0, 'price' => 600.0])
        ]);
        $arBelows = $this->sut->getBelows();
        $this->assertIsArray($arBelows);
        $this->assertCount(3, $arBelows);
        $this->assertContainsOnlyInstancesOf(Below::class, $arBelows);
    }
}
