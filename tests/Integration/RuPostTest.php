<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Enums\PayType;
use DalliSDK\Enums\RuPost;
use DalliSDK\Models\Item;
use DalliSDK\Models\Order;
use DalliSDK\Models\OrderResponse;
use DalliSDK\Models\Receiver;
use DalliSDK\Models\Responses\Error;
use DalliSDK\Models\Responses\Success;
use DalliSDK\Requests\CreateBasketRequest;
use DalliSDK\Requests\RuPostRequest;
use DalliSDK\Responses\CreateBasketResponse;
use DalliSDK\Responses\RuPostResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;
use DateTime;

class RuPostTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('RuPost/Request.xml');

        $order = new Order();
        $receiver = new Receiver();

        $receiver->setAddress('Складочная 1 стр 18')
            ->setTown('Москва')
            ->setFias('f26b876b-6857-4951-b060-ec6559f04a9a')
            ->setPerson('Иванов И. И.')
            ->setPhone('+797777777777')
            ->setZipCode('121552')
            ->setTo('Москва, Складочная 1 стр 18');


        $order->setNumber('123456')
            ->setReceiver($receiver)
            ->setRuPostType(RuPost::COURIER)
            ->setPrice(123.0) // стоимость товарных позиций + стоимость доставки
            ->setInshPrice(123.0)
            ->setInstruction('Передавайте привет');

        $request = new RuPostRequest();
        $this->assertSame(RuPostResponse::class, $request->getResponseClass());

        $request->addOrder($order);


        $this->assertContainsOnlyInstancesOf(Order::class, $request->getOrders());
        $this->assertCount(1, $request->getOrders());

        $this->assertSameXml($xml, $request);
        $request->forgetOrders();
        $this->assertSame([], $request->getOrders());
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response RuPostResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('RuPost/Response.xml'),
            RuPostResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(OrderResponse::class, $response->getItems());

        $orderResponse = $response->getItems()[0];
        $this->assertSame('123', $orderResponse->getNumber());

        $success = $orderResponse->getSuccess();
        $this->assertNull($success);

        $errors = $orderResponse->getErrors();
        $this->assertCount(1, $errors);
        $this->assertCount(1, $errors);
        $this->assertContainsOnlyInstancesOf(Error::class, $errors);
        $error = $errors[0];

        $this->assertSame('number', $error->getError());
        $this->assertSame(4, $error->getErrorCode());
        $this->assertSame('Указанный номер заказа уже есть в системе', $error->getErrorMessage());

        $orderResponse = $response->getItems()[1];
        $this->assertSame('0708A654321', $orderResponse->getBarcode());
    }
}
