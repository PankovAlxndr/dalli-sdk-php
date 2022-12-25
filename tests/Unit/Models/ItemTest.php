<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private Item $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = Item::create([
            'name' => 'Тестовый товар',
            'quantity' => 1,
            'weight' => 100.0,
            'mass' => 100.0,
            'retPrice' => 200.0,
            'inshPrice' => 300.0,
            'barcode' => '19634788',
            'article' => '0023123321',
            'vatRate' => 20,
            'originCountry' => 'Россия',
            'gtd' => '10129000',
            'excise' => 99.0,
            'suppCompany' => 'Рога и Копыта',
            'suppPhone' => '+7(000)000-00-00',
            'suppINN' => '3664069397',
            'governmentCode' => '8708 30',
            'type' => 1,
            'extCode' => '123213123',
        ]);
    }

    public function testGetWeight()
    {
        $this->assertSame(100.0, $this->sut->getWeight());
    }

    public function testGetMass()
    {
        $this->assertSame(100.0, $this->sut->getMass());
    }

    public function testGetQuantity()
    {
        $this->assertSame(1, $this->sut->getQuantity());
    }

    public function testGetRetPrice()
    {
        $this->assertSame(200.0, $this->sut->getRetPrice());
    }

    public function testGetInshPrice()
    {
        $this->assertSame(300.0, $this->sut->getInshPrice());
    }

    public function testGetExtCode()
    {
        $this->assertSame('123213123', $this->sut->getExtCode());
    }

    public function testGetType()
    {
        $this->assertSame(1, $this->sut->getType());
    }

    public function testGetSuppPhone()
    {
        $this->assertSame('+7(000)000-00-00', $this->sut->getSuppPhone());
    }

    public function testGetGtd()
    {
        $this->assertSame('10129000', $this->sut->getGtd());
    }

    public function testGetName()
    {
        $this->assertSame('Тестовый товар', $this->sut->getName());
    }

    public function testGetArticle()
    {
        $this->assertSame('0023123321', $this->sut->getArticle());
    }

    public function testGetExcise()
    {
        $this->assertSame(99.0, $this->sut->getExcise());
    }

    public function testGetVATrate()
    {
        $this->assertSame(20, $this->sut->getVATrate());
    }

    public function testGetSuppCompany()
    {
        $this->assertSame('Рога и Копыта', $this->sut->getSuppCompany());
    }

    public function testGetOriginCountry()
    {
        $this->assertSame('Россия', $this->sut->getOriginCountry());
    }

    public function testGetGovernmentCode()
    {
        $this->assertSame('8708 30', $this->sut->getGovernmentCode());
    }

    public function testGetBarcode()
    {
        $this->assertSame('19634788', $this->sut->getBarcode());
    }

    public function testGetSuppINN()
    {
        $this->assertSame('3664069397', $this->sut->getSuppINN());
    }

    public function testSetMass()
    {
        $this->sut->setMass(555.55);
        $this->assertSame(555.55, $this->sut->getMass());
    }

    public function testSetArticle()
    {
        $this->sut->setArticle('99999999');
        $this->assertSame('99999999', $this->sut->getArticle());
    }

    public function testSetVATrate()
    {
        $this->sut->setVATrate(10);
        $this->assertSame(10, $this->sut->getVATrate());
    }

    public function testSetExcise()
    {
        $this->sut->setExcise(11.0);
        $this->assertSame(11.0, $this->sut->getExcise());
    }

    public function testSetGovernmentCode()
    {
        $this->sut->setGovernmentCode('8708 99');
        $this->assertSame('8708 99', $this->sut->getGovernmentCode());
    }

    public function testSetExtCode()
    {
        $this->sut->setExtCode('12345');
        $this->assertSame('12345', $this->sut->getExtCode());
    }
}
