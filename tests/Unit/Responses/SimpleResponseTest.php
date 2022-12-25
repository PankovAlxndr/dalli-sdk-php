<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Responses;

use DalliSDK\Responses\SimpleResponse;
use PHPUnit\Framework\TestCase;

class SimpleResponseTest extends TestCase
{
    private SimpleResponse $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new SimpleResponse('lorem', 200);
    }


    public function testConstruct()
    {
        $this->assertSame('lorem', $this->sut->getHttpBody());
        $this->assertSame(200, $this->sut->getHttpCode());
    }

    public function testSetHttpBody()
    {
        $this->sut->setHttpBody('lorem 2');
        $this->assertSame('lorem 2', $this->sut->getHttpBody());
    }

    public function testSetHttpCode()
    {
        $this->sut->setHttpCode(404);
        $this->assertSame(404, $this->sut->getHttpCode());
    }
}
