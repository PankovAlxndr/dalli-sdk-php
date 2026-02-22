<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Ads\Ads;
use DalliSDK\Models\Ads\Climb;
use DalliSDK\Models\Below;
use PHPUnit\Framework\TestCase;

class AdsTest extends TestCase
{
    private Ads $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Ads::create([
            'climb' => (new Climb())->setFloor(15)->setType('elevator'),
            'any' => ['foo']
        ]);
    }

    public function testGetClimb()
    {
        $this->assertInstanceOf(Climb::class, $this->sut->getClimb());
        $this->assertSame(15, $this->sut->getClimb()->getFloor());
        $this->assertSame('elevator', $this->sut->getClimb()->getType());
        $this->assertSame(['foo'], $this->sut->getAny());
    }
}
