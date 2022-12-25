<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Models\AdvPrice;
use DalliSDK\Models\Courier;
use DalliSDK\Models\Item;
use DalliSDK\Models\OrderDelivery;
use DalliSDK\Models\Package;
use DalliSDK\Models\Receiver;
use DalliSDK\Models\Status;
use DalliSDK\Models\StatusHistory;
use DalliSDK\Requests\OrderDeliveryStatusCommitRequest;
use DalliSDK\Requests\OrderDeliveryStatusRequest;
use DalliSDK\Responses\OrderDeliveryStatusCommitResponse;
use DalliSDK\Responses\OrderDeliveryStatusResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class OrderDeliveryStatusTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('OrderDeliveryStatus/Request.xml');
        $request = new OrderDeliveryStatusRequest();
        $this->assertSame(OrderDeliveryStatusResponse::class, $request->getResponseClass());

        $request->setOrderNo('20112-00094640')
            ->setDateFrom(\DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-01 00:00:00'))
            ->setDateTo(\DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-02 00:00:00'))
            ->setChanges('ONLY_LAST')
            ->setDateDelivery('YES');

        $this->assertSame('20112-00094640', $request->getOrderNo());
        $this->assertSame('ONLY_LAST', $request->getChanges());
        $this->assertSame('YES', $request->getDateDelivery());
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-01 00:00:00')->getTimestamp(),
            $request->getDateFrom()->getTimestamp()
        );
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-02 00:00:00')->getTimestamp(),
            $request->getDateTo()->getTimestamp()
        );

        $this->assertSameXml($xml, $request);
    }

    public function testCommitRequestSerialization()
    {
        $xml = FixturesLoader::load('OrderDeliveryStatus/CommitRequest.xml');
        $request = new OrderDeliveryStatusCommitRequest();
        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response OrderDeliveryStatusResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('OrderDeliveryStatus/SuccessResponse.xml'),
            OrderDeliveryStatusResponse::class,
            'xml'
        );

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(2, $response->getItems());
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(OrderDelivery::class, $response->getItems());

        $orderDelivery = $response->getItems()[0];

        $this->assertSame('79807', $orderDelivery->getOrderNo());
        $this->assertSame('6846828', $orderDelivery->getOrderCode());
        $this->assertSame('A5913655', $orderDelivery->getGivenCode());
        $this->assertSame('A5913655', $orderDelivery->getAwb());
        $this->assertSame('A5913655', $orderDelivery->getBarcode());
        $this->assertSame(2.05, $orderDelivery->getWeight());
        $this->assertSame(1, $orderDelivery->getQuantity());
        $this->assertSame('NO', $orderDelivery->getPayType());
        $this->assertSame(11, $orderDelivery->getService());
        $this->assertSame(0.0, $orderDelivery->getPrice());
        $this->assertSame(6785.0, $orderDelivery->getInshPrice());
        $this->assertSame('SPI', $orderDelivery->getInstruction());
        $this->assertNull($orderDelivery->getEnclosure());
        $this->assertSame('(МО)', $response->getItems()[1]->getEnclosure());
        //
        $this->assertSame('2024', $orderDelivery->getDepartment());
        $this->assertNull($response->getItems()[1]->getDepartment());
        $this->assertSame('9195_S1', $orderDelivery->getCostCode());
        $this->assertNull($response->getItems()[1]->getCostCode());
        $this->assertNull($orderDelivery->getOutStrBarcode());
        $this->assertSame('12:50:00', $orderDelivery->getDeliveredTime());
        $this->assertNull($orderDelivery->getDeliveredTo());


        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-05 00:00:00')->getTimestamp(),
            $orderDelivery->getDeliveredDate()->setTime(0, 0, 0)->getTimestamp()
        );

        $acta = $orderDelivery->getActa();
        $this->assertNull($acta->getDate());
        $this->assertNull($acta->getName());
        $this->assertSame('2022-12-05', $response->getItems()[1]->getActa()->getDate());
        $this->assertSame('297097', $response->getItems()[1]->getActa()->getName());

        $receiver = $orderDelivery->getReceiver();
        $this->assertInstanceOf(Receiver::class, $receiver);
        $this->assertSame('Евлампий Зигмундович', $receiver->getCompany());
        $this->assertSame('Евлампий Зигмундович', $receiver->getPerson());
        $this->assertSame('+70000000000', $receiver->getPhone());
        $this->assertSame('Санкт-Петербург город', $receiver->getTown());
        $this->assertSame('Выборгское шоссе,13, кв.офис 1', $receiver->getAddress());
        $this->assertSame('09:00', $receiver->getTimeMin());
        $this->assertSame('13:00', $receiver->getTimeMax());
        $this->assertNull($receiver->getZipCode());
        $this->assertNull($receiver->getPvzcode());
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i:s', '2022-12-05 00:00:00')->getTimestamp(),
            $receiver->getDate()->setTime(0, 0)->getTimestamp()
        );

        $courier = $orderDelivery->getCourier();
        $this->assertInstanceOf(Courier::class, $courier);
        $this->assertSame('1136', $courier->getCode());
        $this->assertNull($courier->getPhone());
        $this->assertSame('САНКТ-ПЕТЕРБУРГ', $courier->getName());
        $this->assertSame('2786', $response->getItems()[1]->getCourier()->getCode());
        $this->assertSame('+7010101010101', $response->getItems()[1]->getCourier()->getPhone());
        $this->assertSame('Агафонов Демьян Сергеевич (Павелецкая, 50) Д/Д', $response->getItems()[1]->getCourier()->getName());

        $deliveryPrice = $orderDelivery->getDeliveryPrice();
        $this->assertSame(375.77, $deliveryPrice->getTotal());
        $this->assertNotEmpty($deliveryPrice->getAdvPrices());
        $this->assertCount(5, $deliveryPrice->getAdvPrices());
        $this->assertCount(5, $deliveryPrice);

        $this->assertContainsOnlyInstancesOf(AdvPrice::class, $deliveryPrice->getAdvPrices());
        $advPrice = $deliveryPrice->getAdvPrices()[0];
        $this->assertSame(1, $advPrice->getCode());
        $this->assertSame(255.0, $advPrice->getPrice());
        $this->assertSame('База', $advPrice->getName());

        $status = $orderDelivery->getStatus();
        $this->assertInstanceOf(Status::class, $status);
        $this->assertSame('COMPLETE', $status->getCode());
        $this->assertSame('2022-12-05 12:50:00', $status->getEventtime());
        $this->assertSame('2022-12-06 05:45:37', $status->getCreatetimegmt());
        $this->assertSame('Доставлен', $status->getTitle());
        $this->assertNull($status->getEventstore());

        $statusHistory = $orderDelivery->getStatusHistory();
        $this->assertInstanceOf(StatusHistory::class, $statusHistory);

        $this->assertContainsOnlyInstancesOf(Status::class, $statusHistory->getStatuses());
        $this->assertNotEmpty($statusHistory->getStatuses());
        $this->assertCount(10, $statusHistory->getStatuses());
        $this->assertCount(10, $statusHistory);

        $items = $orderDelivery->getItems();
        $this->assertContainsOnlyInstancesOf(Item::class, $items);
        $this->assertNotEmpty($items);
        $this->assertCount(5, $items);

        $item = $items[0];
        $this->assertSame(1, $item->getQuantity());
        $this->assertSame(0.5, $item->getWeight());
        $this->assertSame(2290.0, $item->getRetPrice());
        $this->assertNull($item->getInshPrice());
        $this->assertSame('00000246', $item->getBarcode());
        $this->assertNull($item->getArticle());
        $this->assertNull($item->getVATrate());
        $this->assertNull($item->getOriginCountry());
        $this->assertNull($item->getGtd());
        $this->assertNull($item->getExcise());
        $this->assertSame('ИП тест', $item->getSuppCompany());
        $this->assertSame('Татьяна +7 (000)000-00-00', $item->getSuppPhone());
        $this->assertSame('780248482864', $item->getSuppINN());
        $this->assertNull($item->getGovernmentCode());
        $this->assertSame(1, $item->getType());
        $this->assertSame('20745637', $item->getExtCode());
        $this->assertSame('Фундук в темном шоколаде', $item->getName());

        $receipt = $orderDelivery->getReceipt();
        $this->assertSame('2022-12-05 12:50:31', $receipt->getDateBeg());
        $this->assertSame('7842152310', $receipt->getInn());
        $this->assertSame('7280440500032759', $receipt->getFnSn());
        $this->assertSame('6577', $receipt->getSumm());
        $this->assertSame('48789', $receipt->getFdNum());
        $this->assertSame('0004781557016457', $receipt->getKktNum());
        $this->assertSame('kkt.ofd.yandex.net', $receipt->getOfdUrl());
        $this->assertSame('0541889653', $receipt->getFdValue());
        $this->assertSame('https://ofd.yandex.ru/vaucher/11111/11111/11111', $receipt->getUrl());


        $packages = $orderDelivery->getPackages();
        $this->assertContainsOnlyInstancesOf(Package::class, $packages);
        $this->assertNotEmpty($packages);
        $this->assertCount(2, $packages);

        $package = $packages[0];
        $this->assertSame(1.0, $package->getLength());
        $this->assertSame(1.0, $package->getWidth());
        $this->assertSame(1.0, $package->getHeight());
        $this->assertSame(1.42, $package->getMass());
        $this->assertNull($package->getMessage());
        $this->assertSame('SNQ15280018800001', $package->getStrBarCode());
    }

    public function testEmptyDeSerialization()
    {
        /** @var $response OrderDeliveryStatusResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('OrderDeliveryStatus/EmptyResponse.xml'),
            OrderDeliveryStatusResponse::class,
            'xml'
        );

        $this->assertEmpty($response->getItems());
        $this->assertCount(0, $response->getItems());
        $this->assertCount(0, $response);
    }

    public function testCommitResponseDeSerialization()
    {
        /** @var $response OrderDeliveryStatusCommitResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('OrderDeliveryStatus/CommitResponse.xml'),
            OrderDeliveryStatusCommitResponse::class,
            'xml'
        );

        $this->assertSame('OK ', $response->getStatus());
        $this->assertSame(0, $response->getError());
    }
}
