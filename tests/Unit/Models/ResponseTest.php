<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Acta;
use DalliSDK\Models\Responses\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    private Response $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Response::create([
            'error' => '0',
            'barcode' => 'A5741950',
            'message' => 'Заявка отменена'
        ]);
    }
    public function testGetError()
    {
        $this->assertFalse($this->sut->getError());
    }

    public function testGetBarcode()
    {
        $this->assertSame('A5741950', $this->sut->getBarcode());
    }

    public function testGetMessage()
    {
        $this->assertSame('Заявка отменена', $this->sut->getMessage());
    }
}
