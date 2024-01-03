<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Enums\PayType;
use DalliSDK\Enums\RuPost;
use DalliSDK\Models\Below;
use DalliSDK\Models\DeliverySet;
use DalliSDK\Models\Item;
use DalliSDK\Models\Order;
use DalliSDK\Models\Package;
use DalliSDK\Models\Receiver;
use DalliSDK\Models\Responses\Error;
use DateTime;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private Order $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $receiver = new Receiver();
        $deliverySet = DeliverySet::create([
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

        $receiver->setAddress('ул. Мусы Джалиля, д.2 к1')
            ->setTown('г. Москва')
            ->setPerson('Константин Константинопольский')
            ->setPhone('+7 000 000 00 00')
            ->setDate(new DateTime('2022-12-25'))
            ->setTimeMin('9:00')
            ->setTimeMax('22:00');

        $item = new Item();
        $item->setQuantity(2)
            ->setName('Моя тестовая товарная позиция')
            ->setWeight(3.15)
            ->setRetPrice(50.0)
            ->setInshPrice(5.0)
            ->setOriginCountry('RU')
            ->setGtd('10702030')
            ->setSuppCompany('Компания поставщик')
            ->setSuppPhone('+7 000 000 00 00')
            ->setSuppInn('3664069397')
            ->setType(1);

        $this->sut = Order::create([
            'barcode' => 'A6015712',
            'number' => 'sdk-006',
            'receiver' => $receiver,
            'department' => 'Код торговой точк',
            'senderCode' => 'RU34234',
            'service' => 1,
            'weight' => 10.0,
            'quantity' => 1,
            'payType' => PayType::CARD,
            'ruPostType' => RuPost::FIRST_CLASS,
            'price' => 199.9,
            'priced' => 200.0,
            'inshPrice' => 10.0,
            'upsnak' => 'F',
            'instruction' => 'Поручение, примечание для курьера',
            'acceptpartially' => 'YES',
            'deliverySet' => $deliverySet,
            'items' => [$item],
            'packages' => [
                Package::create([
                    'strBarCode' => 'A1594134',
                    'mass' => 100.0,
                    'length' => 200.0,
                    'width' => 300.0,
                    'height' => 400.0,
                    'message' => 'Корневой контейнер',
                ])],
            'errors' => [
                Error::create([
                    'error' => 'item',
                    'errorCode' => 13,
                    'errorMessage' => 'Сообщение об ошибке',
                ])],
        ]);
    }

    public function testSetPriced()
    {
        $this->sut->setPriced(11.0);
        $this->assertSame(11.0, $this->sut->getPriced());
    }

    public function testSetDeliverySet()
    {
        $deliverySet = DeliverySet::create([
            'abovePrice' => 111.0,
            'returnPrice' => 222.0,
            'vatRate' => 22,
            'belows' => [
                Below::create([
                    'belowSum' => 333.0,
                    'price' => 444.0,
                ]),
                Below::create([
                    'belowSum' => 555.0,
                    'price' => 666.0,
                ])
            ]
        ]);

        $this->sut->setDeliverySet($deliverySet);
        $this->assertInstanceOf(DeliverySet::class, $this->sut->getDeliverySet());
        $this->assertSame(111.0, $this->sut->getDeliverySet()->getAbovePrice());
        $this->assertSame(222.0, $this->sut->getDeliverySet()->getReturnPrice());
        $this->assertSame(22, $this->sut->getDeliverySet()->getVatRate());
        $this->assertContainsOnlyInstancesOf(Below::class, $this->sut->getDeliverySet()->getBelows());
    }

    public function testSetReceiver()
    {
        $this->sut->setReceiver(Receiver::create([
            'town' => 'Москва город 2',
            'address' => 'Тестовая улица 2',
            'pvzcode' => 'RU_630 2',
            'zipCode' => '150000 2',
            'person' => 'Тестовый получатель 2',
            'company' => 'Тестовый получатель 2',
            'phone' => '+7(000)000-00-02',
            'date' => \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-02 00:00:00'),
            'timeMin' => '09:00',
            'timeMax' => '22:00',
        ]));

        $this->assertInstanceOf(Receiver::class, $this->sut->getReceiver());
        $this->assertSame('Москва город 2', $this->sut->getReceiver()->getTown());
        $this->assertSame('Тестовая улица 2', $this->sut->getReceiver()->getAddress());
        $this->assertSame('RU_630 2', $this->sut->getReceiver()->getPvzcode());
        $this->assertSame('150000 2', $this->sut->getReceiver()->getZipCode());
        $this->assertSame('Тестовый получатель 2', $this->sut->getReceiver()->getPerson());
        $this->assertSame('Тестовый получатель 2', $this->sut->getReceiver()->getCompany());
        $this->assertSame('+7(000)000-00-02', $this->sut->getReceiver()->getPhone());
        $this->assertSame('09:00', $this->sut->getReceiver()->getTimeMin());
        $this->assertSame('22:00', $this->sut->getReceiver()->getTimeMax());

        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-02 00:00:00');
        $this->assertEquals($dt, $this->sut->getReceiver()->getDate());
    }

    public function testSetNumber()
    {
        $this->sut->setNumber('15051505');
        $this->assertSame('15051505', $this->sut->getNumber());
    }

    public function testSetPackages()
    {
        $this->sut->setPackages([
            Package::create([
                'strBarCode' => 'A1594134-2',
                'mass' => 111.0,
                'length' => 222.0,
                'width' => 333.0,
                'height' => 444.0,
                'message' => 'Корневой контейнер 2',
            ])]);
        $this->assertContainsOnlyInstancesOf(Package::class, $this->sut->getPackages());
        $this->assertCount(1, $this->sut->getPackages());
        $package = $this->sut->getPackages()[0];

        $this->assertSame('A1594134-2', $package->getStrBarCode());
        $this->assertSame(111.0, $package->getMass());
        $this->assertSame(222.0, $package->getLength());
        $this->assertSame(333.0, $package->getWidth());
        $this->assertSame(444.0, $package->getHeight());
        $this->assertSame('Корневой контейнер 2', $package->getMessage());
    }

    public function testSetInstruction()
    {
        $this->sut->setInstruction('lorem');
        $this->assertSame('lorem', $this->sut->getInstruction());
    }

    public function testSetItems()
    {
        $this->sut->setItems([
            Item::create([
                'name' => 'Тестовый товар 3000',
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
            ])
        ]);

        $this->assertContainsOnlyInstancesOf(Item::class, $this->sut->getItems());
        $this->assertCount(1, $this->sut->getItems());
        $item = $this->sut->getItems()[0];
        $this->assertSame('Тестовый товар 3000', $item->getName());
    }

    public function testSetDepartment()
    {
        $this->sut->setDepartment('department');
        $this->assertSame('department', $this->sut->getDepartment());
    }

    public function testSetWeight()
    {
        $this->sut->setWeight(9999.0);
        $this->assertSame(9999.0, $this->sut->getWeight());
    }

    public function testSetAcceptpartially()
    {
        $this->sut->setAcceptpartially('NO');
        $this->assertSame('NO', $this->sut->getAcceptpartially());
    }

    public function testSetBarcode()
    {
        $this->sut->setBarcode('987654321');
        $this->assertSame('987654321', $this->sut->getBarcode());
    }

    public function testSetUpsnak()
    {
        $this->sut->setUpsnak('T');
        $this->assertSame('T', $this->sut->getUpsnak());
    }

    public function testSetQuantity()
    {
        $this->sut->setQuantity(9);
        $this->assertSame(9, $this->sut->getQuantity());
    }

    public function testSetService()
    {
        $this->sut->setService(4);
        $this->assertSame(4, $this->sut->getService());
    }

    public function testSetPayType()
    {
        $this->sut->setPayType(PayType::NO);
        $this->assertSame(PayType::NO, $this->sut->getPayType());
    }

    public function testSetRuPostType()
    {
        $this->sut->setRuPostType(RuPost::COURIER);
        $this->assertSame(RuPost::COURIER, $this->sut->getRuPostType());
    }

    public function testSetPrice()
    {
        $this->sut->setPrice(33.5);
        $this->assertSame(33.5, $this->sut->getPrice());
    }

    public function testSetInshPrice()
    {
        $this->sut->setInshPrice(55.3);
        $this->assertSame(55.3, $this->sut->getInshPrice());
    }

    public function testSetSenderCode()
    {
        $this->sut->setSenderCode('AS332341');
        $this->assertSame('AS332341', $this->sut->getSenderCode());
    }
}
