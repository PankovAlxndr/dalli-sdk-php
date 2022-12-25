<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Enums\PayType;
use DalliSDK\Models\Below;
use DalliSDK\Models\DeliverySet;
use DalliSDK\Models\Item;
use DalliSDK\Models\Order;
use DalliSDK\Models\OrderResponse;
use DalliSDK\Models\Receiver;
use DalliSDK\Models\Responses\Error;
use DalliSDK\Models\Responses\Success;
use DalliSDK\Requests\EditBasketRequest;
use DalliSDK\Responses\EditBasketResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;
use DateTime;

class EditBasketTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('EditOrder/Request.xml');

        $items = [];
        $item1 = new Item();
        $item2 = new Item();
        $order = new Order();
        $receiver = new Receiver();
        $deliverySet = new DeliverySet();

        $receiver->setAddress('Тестовая улица')
            ->setTown('Москва город')
            ->setPerson('Частичка разрешена')
            ->setPhone('79999999999')
            ->setDate(new DateTime('2019-08-10'))
            ->setTimeMin('12:00')
            ->setTimeMax('22:00');

        $deliverySet->setAbovePrice(100.0)
            ->setReturnPrice(10.0)
            ->setBelows([
                new Below(['belowSum' => 500.0, 'price' => 400.0]),
                new Below(['belowSum' => 2000.0, 'price' => 300.0])
            ]);

        $item1->setQuantity(1)
            ->setName('qwerty')
            ->setBarcode('19634788');

        $item2->setQuantity(1)
            ->setName('Карандаш')
            ->setRetPrice(1000.0)
            ->setBarcode('19634791');

        $items[] = $item1;
        $items[] = $item2;

        $order->setNumber('ABC-3')
            ->setBarcode('A1593159')
            ->setReceiver($receiver)
            ->setService(1)
            ->setWeight(0.25)
            ->setQuantity(1)
            ->setPayType(PayType::CASH)
            ->setPrice(1100.0) // стоимость товарных позиций + стоимость доставки
            ->setPriced(100.0)
            ->setInshPrice(2184.0)
            ->setDeliverySet($deliverySet)
            ->setUpsnak('T')
            ->setAcceptpartially('NO')
            ->setInstruction('Заявка с указанием населенного пункта в формате КЛАДР, с опцией "возврат накладных"')
            ->setItems($items);

        $request = new EditBasketRequest();
        $this->assertSame(EditBasketResponse::class, $request->getResponseClass());

        $request->setOrder($order);
        $this->assertInstanceOf(Order::class, $request->getOrder());
        $this->assertSameXml($xml, $request);
    }

    public function testErrorDeSerialization()
    {
        /** @var $response EditBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('EditOrder/Response.xml'),
            EditBasketResponse::class,
            'xml'
        );

        $order = $response->getItem();
        $this->assertInstanceOf(OrderResponse::class, $order);
        $this->assertSame('sdk-006', $order->getNumber());
        $errors = $order->getErrors();
        $success = $order->getSuccess();
        $this->assertCount(0, $errors);
        $this->assertInstanceOf(Success::class, $success);
        $this->assertSame($success->getBarcode(), 'A6015712');
    }

    public function testNotFoundDeSerialization()
    {
        /** @var $response EditBasketResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('EditOrder/NotFoundResponse.xml'),
            EditBasketResponse::class,
            'xml'
        );

        $order = $response->getItem();
        $this->assertInstanceOf(OrderResponse::class, $order);
        $this->assertSame('sdk-006', $order->getNumber());

        $errors = $order->getErrors();
        $success = $order->getSuccess();

        $this->assertNull($success);

        $this->assertContainsOnlyInstancesOf(Error::class, $errors);

        $error = $errors[0];
        $this->assertSame('barcode', $error->getError());
        $this->assertSame(37, $error->getErrorCode());
        $this->assertSame('Штрих-код не найден в корзине', $error->getErrorMessage());
    }
}
