<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\OrderTransferReturn;
use DalliSDK\Models\TransferReturnAct;
use DalliSDK\Requests\Act\TransferReturn\ActTransferReturnRequest;
use DalliSDK\Responses\Act\TransferReturns\ActTransferReturnResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class ActTransferReturnTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('TransferReturns/Request.xml');

        $request = new ActTransferReturnRequest();
        $request->setFrom(\DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00'))
            ->setTo(\DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-02 00:00:00'))
            ->setANumber('894821');

        $this->assertSame(ActTransferReturnResponse::class, $request->getResponseClass());
        $this->assertSameXml($xml, $request);

        $this->assertSame('XML', $request->getOutput());
        $this->assertSame('YES', $request->getDetail());

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-01 00:00:00')->getTimestamp(),
            $request->getFrom()->setTime(0, 0)->getTimestamp()
        );

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2023-01-02  00:00:00')->getTimestamp(),
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

        $this->assertSame('894821', $request->getANumber());

        $request->setANumber('12345');
        $this->assertSame('12345', $request->getANumber());
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response ActTransferReturnResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('TransferReturns/SuccessResponse.xml'),
            ActTransferReturnResponse::class,
            'xml'
        );

        $acts = $response->getActs();
        $this->assertNotEmpty($response->getActs());
        $this->assertCount(1, $response->getActs());
        $this->assertCount(1, $acts);
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(TransferReturnAct::class, $response->getActs());

        $act = $response->getActs()[0];
        $this->assertSame('894821', $act->getNumber());

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-07-27 00:00:00')->getTimestamp(),
            $act->getDate()->setTime(0, 0)->getTimestamp()
        );

        $orders = $act->getOrders();
        $this->assertNotEmpty($act->getOrders());
        $this->assertCount(2, $act->getOrders());
        $this->assertCount(2, $act);
        $this->assertCount(2, $orders);
        $this->assertContainsOnlyInstancesOf(OrderTransferReturn::class, $act->getOrders());

        $order = $orders[0];
        $this->assertSame('6144984', $order->getACode());
        $this->assertSame('A5428842', $order->getBarcode());
        $this->assertSame('62876792', $order->getNumber());

        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-07-25 00:00:00')->getTimestamp(),
            $order->getDeliveredDate()->setTime(0, 0)->getTimestamp()
        );
        $this->assertSame('11:55:00', $order->getDeliveredTime());
        $this->assertSame('по письму им', $order->getDeliveredTo());
        $this->assertSame(1, $order->getReturnQty());
        $this->assertSame('Документы: Заявление на перенос', $order->getProductName());
        $this->assertSame('1-8970109006864173283-3', $order->getGovernmentCode());

        $this->assertSame('212313231', $order->getClientBarCode());
    }

    public function testErrorDeSerialization()
    {
        /** @var $response ActTransferReturnResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('TransferReturns/ErrorResponse.xml'),
            ActTransferReturnResponse::class,
            'xml'
        );


        $this->assertEmpty($response->getActs());
        $this->assertSame(2, $response->getError());
        $this->assertSame('Акты не найдены', $response->getErrorMsg());
    }
}
