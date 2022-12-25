<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\AdvPrice;
use DalliSDK\Models\DeliveryPrice;
use PHPUnit\Framework\TestCase;

class DeliveryPriceTest extends TestCase
{
    private DeliveryPrice $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = DeliveryPrice::create([
            'total' => 100.0,
            'advPrices' => [
                AdvPrice::create([
                    'code' => 1,
                    'price' => 200.0,
                    'name' => 'База 1'
                ]),
                AdvPrice::create([
                    'code' => 2,
                    'price' => 300.0,
                    'name' => 'База 2'
                ]),
            ]
        ]);
    }

    public function testGetAdvPrices()
    {
        $arAdvPrices = $this->sut->getAdvPrices();
        $this->assertIsArray($arAdvPrices);
        $this->assertCount(2, $arAdvPrices);
        $this->assertContainsOnlyInstancesOf(AdvPrice::class, $arAdvPrices);
    }

    public function testGetTotal()
    {
        $this->assertSame(100.0, $this->sut->getTotal());
    }
}
