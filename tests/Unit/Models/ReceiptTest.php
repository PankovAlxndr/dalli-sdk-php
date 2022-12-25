<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Receipt;
use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{
    private Receipt $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Receipt::create([
            'inn' => '7736660000',
            'fnSn' => '9287440300790000',
            'summ' => '630',
            'fdNum' => '107000',
            'kktNum' => '0004477016018000',
            'ofdUrl' => 'platformaofd.ru',
            'fdValue' => '3490289064',
            'url' => 'https://lk.platformaofd.ru/web/noauth/cheque?fn=9287440300790000&amp;fp=3490289000&amp;i=107000',
        ]);
    }

    public function testGetOfdUrl()
    {
        $this->assertSame('platformaofd.ru', $this->sut->getOfdUrl());
    }

    public function testGetFdValue()
    {
        $this->assertSame('3490289064', $this->sut->getFdValue());
    }

    public function testGetInn()
    {
        $this->assertSame('7736660000', $this->sut->getInn());
    }

    public function testGetKktNum()
    {
        $this->assertSame('0004477016018000', $this->sut->getKktNum());
    }

    public function testGetSumm()
    {
        $this->assertSame('630', $this->sut->getSumm());
    }

    public function testGetFdNum()
    {
        $this->assertSame('107000', $this->sut->getFdNum());
    }

    public function testGetUrl()
    {
        $this->assertSame(
            'https://lk.platformaofd.ru/web/noauth/cheque?fn=9287440300790000&amp;fp=3490289000&amp;i=107000',
            $this->sut->getUrl()
        );
    }

    public function testGetFnSn()
    {
        $this->assertSame('9287440300790000', $this->sut->getFnSn());
    }
}
