<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Traits;

use DalliSDK\Models\AdvPrice;
use DalliSDK\Traits\Fillable;
use PHPUnit\Framework\TestCase;

class FillableTest extends TestCase
{
    public function testConstruct()
    {
        $this->expectException(\InvalidArgumentException::class);
        $advPrice = new AdvPrice([
            'code' => 1,
            'name' => 'test',
            'my_custom_nonexistent_property' => 'custom',
        ]);
    }

    public function testCreate()
    {
        $advPrice = new AdvPrice([
            'code' => 1,
            'name' => 'test',
        ]);

        $this->assertSame(1, $advPrice->getCode());
        $this->assertSame('test', $advPrice->getName());
    }
}
