<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Enums\PayType;
use DalliSDK\Models\Item;
use DalliSDK\Models\Order;
use DalliSDK\Models\OrderResponse;
use DalliSDK\Models\Receiver;
use DalliSDK\Models\Responses\Error;
use DalliSDK\Models\Responses\Success;
use DalliSDK\Requests\CreateBasketRequest;
use DalliSDK\Responses\CreateBasketResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;
use DateTime;

class CreateBasketTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('Order/CreateBasketRequest.xml');

        $items = [];
        $item = new Item();
        $order = new Order();
        $receiver = new Receiver();

        $receiver->setAddress('ул. Мусы Джалиля, д.2 к1')
            ->setTown('г. Москва')
            ->setFias('f26b876b-6857-4951-b060-ec6559f04a9a')
            ->setPerson('Константин Константинопольский')
            ->setPhone('+7 000 000 00 00')
            ->setDate(new DateTime('2022-12-23'))
            ->setTimeMin('18:00')
            ->setTimeMax('22:00');

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
        $items[] = $item;

        $order->setNumber('sdk-002')
            ->setReceiver($receiver)
            ->setService(1)
            ->setWeight(3.15)
            ->setQuantity(1)
            ->setPayType(PayType::CASH)
            ->setPrice(150.0) // стоимость товарных позиций + стоимость доставки
            ->setPriced(50.0)
            ->setInshPrice(500.0)
            ->setInstruction('Максимально аккуратно')
            ->setItems($items);


        $request = new CreateBasketRequest();
        $this->assertSame(CreateBasketResponse::class, $request->getResponseClass());

        $this->assertFalse($request->getAutoSend());

        $request->addOrder($order);
        $this->assertContainsOnlyInstancesOf(Order::class, $request->getOrders());
        $this->assertCount(1, $request->getOrders());

        $this->assertSameXml($xml, $request);

        $request->forgetOrders();
        $this->assertSame([], $request->getOrders());
    }

    public function testSuccessfulSerializationWithAutoSend()
    {
        $xml = FixturesLoader::load('Order/CreateBasketWithAutoSendRequest.xml');

        $items = [];
        $item = new Item();
        $order = new Order();
        $receiver = new Receiver();

        $receiver->setAddress('ул. Мусы Джалиля, д.2 к1')
            ->setTown('г. Москва')
            ->setFias('f26b876b-6857-4951-b060-ec6559f04a9a')
            ->setPerson('Константин Константинопольский')
            ->setPhone('+7 000 000 00 00')
            ->setDate(new DateTime('2022-12-23'))
            ->setTimeMin('18:00')
            ->setTimeMax('22:00');

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
        $items[] = $item;

        $order->setNumber('sdk-002')
            ->setReceiver($receiver)
            ->setService(1)
            ->setWeight(3.15)
            ->setQuantity(1)
            ->setPayType(PayType::CASH)
            ->setPrice(150.0) // стоимость товарных позиций + стоимость доставки
            ->setPriced(50.0)
            ->setInshPrice(500.0)
            ->setInstruction('Максимально аккуратно')
            ->setItems($items);


        $request = new CreateBasketRequest();
        $request->setAutoSend();
        $this->assertTrue($request->getAutoSend());
        $this->assertSame(CreateBasketResponse::class, $request->getResponseClass());


        $request->addOrder($order);
        $this->assertContainsOnlyInstancesOf(Order::class, $request->getOrders());
        $this->assertCount(1, $request->getOrders());

        $this->assertSameXml($xml, $request);

        $request->forgetOrders();
        $this->assertSame([], $request->getOrders());

        $request->removeAutoSend();
        $this->assertFalse($request->getAutoSend());
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response CreateBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Order/CreateBasketSuccessResponse.xml'),
            CreateBasketResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(1, $response->getItems());
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(OrderResponse::class, $response->getItems());

        $orderResponse = $response->getItems()[0];
        $this->assertSame('sdk-002', $orderResponse->getNumber());

        $success = $orderResponse->getSuccess();
        $this->assertInstanceOf(Success::class, $success);
        $this->assertSame('A6000453', $success->getBarcode());
    }

    public function testErrorDeSerialization()
    {
        /** @var $response CreateBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('Order/CreateBasketErrorResponse.xml'),
            CreateBasketResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(1, $response->getItems());
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(OrderResponse::class, $response->getItems());

        $orderResponse = $response->getItems()[0];
        $this->assertSame('sdk-002', $orderResponse->getNumber());

        $errors = $orderResponse->getErrors();
        $this->assertNotEmpty($response->getItems());
        $this->assertCount(4, $errors);
        $this->assertContainsOnlyInstancesOf(Error::class, $errors);

        $error = $orderResponse->getErrors()[0];
        $this->assertInstanceOf(Error::class, $error);
        $this->assertSame('time_max', $error->getError());
        $this->assertSame(16, $error->getErrorCode());
        $this->assertSame('Некорректно указано максимальное время доставки', $error->getErrorMessage());

        $error = $orderResponse->getErrors()[1];
        $this->assertInstanceOf(Error::class, $error);
        $this->assertSame('interval', $error->getError());
        $this->assertSame(14, $error->getErrorCode());
        $this->assertSame('Некорректно указан временной интервал доставки', $error->getErrorMessage());
    }
}
