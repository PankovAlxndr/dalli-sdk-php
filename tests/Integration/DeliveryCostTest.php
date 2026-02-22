<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Enums\Partner;
use DalliSDK\Models\Package;
use DalliSDK\Models\PackageDeliveryCost;
use DalliSDK\Models\Price;
use DalliSDK\Requests\DeliveryCostRequest;
use DalliSDK\Responses\DeliveryCostResponse;
use DalliSDK\Test\Fixtures\FixturesLoader;

class DeliveryCostTest extends SerializerTestCase
{
    public function testSuccessfulSerialization()
    {
        $xml = FixturesLoader::load('DeliveryCost/Request.xml');
        $request = new DeliveryCostRequest();
        $this->assertSame(DeliveryCostResponse::class, $request->getResponseClass());

        $request->setPartner(Partner::SDEK)
            ->setFias('0c5b2444-70a0-4932-980c-b4dc0d3f02b5')
            ->setOblName('Ярославкая')
            ->setWeight(25.3)
            ->setPrice(500)
            ->setInshprice(500)
            ->setCashServices('YES')
            ->setLength(50)
            ->setWidth(50)
            ->setHeight(50)
            ->setTypeDelivery('PVZ')
            ->setKladr('kladr')
            ->setTo('to')
            ->setTownTo('Town to')
            ->setPvzCode('pvz code')
            ->setCdekCityId(44)
            ->setYandexCityId(95)
            ->setWithoutTax('YES')
            ->setOutput('x2')
            ->setSenderCode('RU34234');

        $request->addPackage(
            (new PackageDeliveryCost())
                ->setWidth(10)
                ->setHeight(10)
                ->setLength(10)
                ->setWeight(10)
        );

        $request->addPackage(
            (new PackageDeliveryCost())
                ->setWidth(11)
                ->setHeight(11)
                ->setLength(11)
                ->setWeight(11),
        );
        $request->setPackages([
            (new PackageDeliveryCost())
                ->setWidth(10)
                ->setHeight(10)
                ->setLength(10)
                ->setWeight(10),
            (new PackageDeliveryCost())
                ->setWidth(11)
                ->setHeight(11)
                ->setLength(11)
                ->setWeight(11),
        ]);


        $this->assertSame(Partner::SDEK, $request->getPartner());
        $this->assertSame('0c5b2444-70a0-4932-980c-b4dc0d3f02b5', $request->getFias());
        $this->assertSame('Ярославкая', $request->getOblName());
        $this->assertSame(25.3, $request->getWeight());
        $this->assertSame(500, $request->getPrice());
        $this->assertSame(500, $request->getInshprice());
        $this->assertSame('YES', $request->getCashServices());
        $this->assertSame(50, $request->getLength());
        $this->assertSame(50, $request->getWidth());
        $this->assertSame(50, $request->getHeight());
        $this->assertSame('PVZ', $request->getTypeDelivery());
        $this->assertSame('YES', $request->getWithoutTax());
        $this->assertSame('x2', $request->getOutput());

        $this->assertSame('kladr', $request->getKladr());
        $this->assertSame('to', $request->getTo());
        $this->assertSame('Town to', $request->getTownTo());
        $this->assertSame('pvz code', $request->getPvzCode());
        $this->assertSame(44, $request->getCdekCityId());
        $this->assertSame(95, $request->getYandexCityId());
        $this->assertSame('RU34234', $request->getSenderCode());

        $this->assertCount(2, $request->getPackages());
        $this->assertContainsOnlyInstancesOf(PackageDeliveryCost::class, $request->getPackages());

        $this->assertSameXml($xml, $request);
    }

    public function testSuccessfulDeSerialization()
    {
        /** @var $response DeliveryCostResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('DeliveryCost/SuccessResponse.xml'),
            DeliveryCostResponse::class,
            'xml'
        );
        $this->assertSame('DS', $response->getPartner());
        $this->assertSame('Москва, Складочная 1 стр 18', $response->getTownTo());
        $this->assertSame('0', $response->getZone());
        $this->assertSame(20, $response->getVatRate());
        $this->assertSame('1', $response->getDeliveryPeriod());
        $this->assertSame(1, $response->getPrice());
        $this->assertSame('KUR', $response->getTypeDelivery());
        $this->assertSame(1, $response->getService());
        $this->assertSame(1, $response->getToFilial());
        $this->assertSame(110, $response->getDays());

        $this->assertNotEmpty($response->getItems());
        $this->assertCount(3, $response->getItems());
        $this->assertCount(3, $response);
        $this->assertContainsOnlyInstancesOf(Price::class, $response->getItems());

        $price = $response->getItems()[0];

        $this->assertSame(255, $price->getPrice());
        $this->assertSame('0', $price->getZone());
        $this->assertSame(1, $price->getService());
        $this->assertSame('Доставка на следующий день после передачи заказа в курьерскую службу', $price->getMsg());
        $this->assertSame('0-1', $price->getDeliveryPeriod());
    }

    public function testSuccessfulCdekDeSerialization()
    {
        /** @var $response DeliveryCostResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('DeliveryCost/SuccessCdekResponse.xml'),
            DeliveryCostResponse::class,
            'xml'
        );

        $this->assertSame('SDEK', $response->getPartner());
        $this->assertSame(748, $response->getPrice());
        $this->assertSame('2-2', $response->getDeliveryPeriod());
        $this->assertSame('+1 день обработка заказа для передачи партнеру', $response->getMsg());
        $this->assertNull($response->getTownTo());
        $this->assertNull($response->getZone());
    }

    public function testSuccessfulErrorDeSerialization()
    {
        /** @var $response DeliveryCostResponse */
        $response = $this->getSerializer()->deserialize(
            FixturesLoader::load('DeliveryCost/ErrorResponse.xml'),
            DeliveryCostResponse::class,
            'xml'
        );

        $this->assertNull($response->getPartner());
        $this->assertNull($response->getPrice());
        $this->assertNull($response->getDeliveryPeriod());
        $this->assertNull($response->getMsg());
        $this->assertNull($response->getTownTo());
        $this->assertNull($response->getZone());
        $this->assertSame(3, $response->getError());
        $this->assertSame('Не найден город получатель', $response->getErrorMsg());
    }
}
