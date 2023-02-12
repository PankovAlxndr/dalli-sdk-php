<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\OrderTransferMoney;
use DalliSDK\Models\TransferMoneyAct;
use DalliSDK\Requests\Act\TransferMoney\ActTransferMoneyRequest;
use DalliSDK\Responses\Act\TransferMoney\ActTransferMoneyResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class ActTransferMoneyTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('TransferMoney/Request.xml');

        $request = new ActTransferMoneyRequest(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-02-10 00:00:00'),
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-02-12 00:00:00')
        );

        $this->assertSame(ActTransferMoneyResponse::class, $request->getResponseClass());
        $this->assertSameXml($xml, $request);

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-02-10 00:00:00')->getTimestamp(),
            $request->getFrom()->setTime(0, 0)->getTimestamp()
        );

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-02-12 00:00:00')->getTimestamp(),
            $request->getTo()->setTime(0, 0)->getTimestamp()
        );

        $request->setFrom(\DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-11 00:00:00'));
        $request->setTo(\DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-12 00:00:00'));

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-11 00:00:00')->getTimestamp(),
            $request->getFrom()->setTime(0, 0)->getTimestamp()
        );

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-12 00:00:00')->getTimestamp(),
            $request->getTo()->setTime(0, 0)->getTimestamp()
        );
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response ActTransferMoneyResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('TransferMoney/SuccessResponse.xml'),
            ActTransferMoneyResponse::class,
            'xml'
        );

        $acts = $response->getActs();
        $this->assertNotEmpty($response->getActs());
        $this->assertCount(1, $response->getActs());
        $this->assertCount(1, $acts);
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(TransferMoneyAct::class, $response->getActs());

        $act = $response->getActs()[0];
        $this->assertSame('267870', $act->getNumber());

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-05-16 00:00:00')->getTimestamp(),
            $act->getDate()->setTime(0, 0)->getTimestamp()
        );
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-05-16 00:00:00')->getTimestamp(),
            $act->getPay()->setTime(0, 0)->getTimestamp()
        );

        $this->assertSame(1981427.00, $act->getPrice());
        $this->assertSame(6129, $act->getPayNo());


        $orders = $act->getOrders();
        $this->assertNotEmpty($act->getOrders());
        $this->assertCount(1, $act->getOrders());
        $this->assertCount(1, $act);
        $this->assertCount(1, $orders);
        $this->assertContainsOnlyInstancesOf(OrderTransferMoney::class, $act->getOrders());


        $order = $orders[0];
        $this->assertSame('A5185814', $order->getStrBarCode());
        $this->assertSame('61339918', $order->getNumber());
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-05-14 00:00:00')->getTimestamp(),
            $order->getDeliveredDate()->setTime(0, 0)->getTimestamp()
        );
        $this->assertSame(0.0, $order->getPrice());
        $this->assertSame(320.0, $order->getService());
        $this->assertSame(0.0, $order->getTransfer());
    }

    public function testErrorDeSerialization()
    {
        /** @var $response ActTransferMoneyResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('TransferMoney/ErrorResponse.xml'),
            ActTransferMoneyResponse::class,
            'xml'
        );


        $this->assertEmpty($response->getActs());
        $this->assertSame(1, $response->getError());
        $this->assertSame('Не указана дата, с которой начать поиск', $response->getErrorMsg());
    }
}
