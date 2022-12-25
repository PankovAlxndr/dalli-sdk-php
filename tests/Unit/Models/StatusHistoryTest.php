<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Status;
use DalliSDK\Models\StatusHistory;
use PHPUnit\Framework\TestCase;

class StatusHistoryTest extends TestCase
{
    private StatusHistory $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = StatusHistory::create([
            'statuses' => [
                Status::create([
                    'eventtime' => '2020-09-03 17:33:00',
                    'createtimegmt' => '2020-09-04 04:13:59',
                    'title' => 'Доставлен',
                    'code' => 'COMPLETE',
                ]),
                Status::create([
                    'eventtime' => '2020-09-03 14:34:24',
                    'createtimegmt' => '2020-09-03 14:34:24',
                    'title' => 'Доставлен (предварительно)',
                    'code' => 'COURIERDELIVERED',
                ]),
            ]
        ]);
    }


    public function testGetStatuses()
    {
        $arAdvPrices = $this->sut->getStatuses();
        $this->assertIsArray($arAdvPrices);
        $this->assertCount(2, $arAdvPrices);
        $this->assertContainsOnlyInstancesOf(Status::class, $arAdvPrices);
    }
}
