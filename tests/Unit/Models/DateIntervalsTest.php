<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\DateIntervals;
use PHPUnit\Framework\TestCase;

class DateIntervalsTest extends TestCase
{
    private DateIntervals $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = DateIntervals::create([
            'value' => \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2026-02-22 00:00:00'),
        ]);
    }

    public function testGetValue()
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2026-02-22 00:00:00');
        $this->assertEquals($date->getTimestamp(), $this->sut->getValue()->getTimestamp());
    }

    public function testGetIntervals()
    {
        $this->assertNull($this->sut->getIntervals());
    }
}
