<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\DeliveryCostResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на предварительный расчет стоимости
 *
 * @see https://api.dalli-service.com/v1/doc/cost-delivery
 * @JMS\XmlRoot("deliverycost")
 */
class DeliveryCostRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = DeliveryCostResponse::class;

    /**
     * Идентификатор партнера, может принимать значения
     * @JMS\Type("string")
     */
    private ?string $partner = null;

    /**
     * Полный адрес получателя. Доступен только для собственной доставки Dalli
     *
     * @JMS\Type("string")
     */
    private ?string $to = null;

    /**
     * Город доставки в текстовом виде. Не рекомендуется
     *
     * @deprecated Не рекомендуется
     * @JMS\Type("string")
     * @JMS\SerializedName("townto")
     */
    private ?string $townTo = null;

    /**
     * Код ФИАС. Рекомендуем использовать именно его, а не текстовое название города
     *
     * @JMS\Type("string")
     */
    private ?string $fias = null;

    /**
     * КЛАДР
     *
     * @JMS\Type("string")
     */
    private ?string $kladr = null;

    /**
     * Код пункта выдачи заказов
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("pvzcode")
     */
    private ?string $pvzCode = null;

    /**
     * Код города в системе СДЕК(можно указывать только при доставке СДЕКом)
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("cdekcityid")
     */
    private ?int $cdekCityId = null;

    /**
     * Область
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("oblname")
     */
    private ?string $oblName = null;

    /**
     * Вес заказа, кг
     *
     * @JMS\Type("int")
     */
    private ?int $weight = null;

    /**
     * Стоимость заказа
     *
     * @JMS\Type("int")
     */
    private ?int $price = null;

    /**
     * Объявленная стоимость заказа
     *
     * @JMS\Type("int")
     */
    private ?int $inshprice = null;

    /**
     * Оплата картой (используется для запроса стоимости доставки только DS), может принимать значения:
     *  NO - наличными (значение по-умолчанию)
     *  YES - картой
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("cashservices")
     */
    private ?string $cashServices = 'NO';

    /**
     * Длина, см
     *
     * @JMS\Type("int")
     */
    private ?int $length = null;

    /**
     * Ширина, см
     *
     * @JMS\Type("int")
     */
    private ?int $width = null;

    /**
     * Высота, см
     *
     * @JMS\Type("int")
     */
    private ?int $height = null;

    /**
     * Тип доставки, может принимать значения (бесполезен при output x2):
     *  KUR - курьерская доставка
     *  PVZ - пункт выдачи заказов ПВЗ
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("typedelivery")
     */
    private ?string $typeDelivery = null;

    /**
     * Запрос базовой стоимости доставки (используется для запроса стоимости доставки только DS), может принимать значения:
     *  NO - Полная стоимость, включающая все комиссии (значение по-умолчанию)
     *  YES - Базовая стоимость доставки без доп услуг
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("withouttax")
     */
    private ?string $withoutTax = null;

    /**
     * Меняет формат ответа
     *  x2 - расширенный формат. Обязателен для Почты России
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("output")
     */
    private ?string $output = null;

    /**
     * @return string|null
     */
    public function getPartner(): ?string
    {
        return $this->partner;
    }

    /**
     * @param string|null $partner
     *
     * @return DeliveryCostRequest
     */
    public function setPartner(?string $partner): DeliveryCostRequest
    {
        $this->partner = $partner;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * @param string|null $to
     *
     * @return DeliveryCostRequest
     */
    public function setTo(?string $to): DeliveryCostRequest
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string|null
     * @deprecated Не рекомендуется
     */
    public function getTownTo(): ?string
    {
        return $this->townTo;
    }

    /**
     *
     * @param string|null $townTo
     *
     * @return DeliveryCostRequest
     * @deprecated Не рекомендуется
     *
     */
    public function setTownTo(?string $townTo): DeliveryCostRequest
    {
        $this->townTo = $townTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFias(): ?string
    {
        return $this->fias;
    }

    /**
     * @param string|null $fias
     *
     * @return DeliveryCostRequest
     */
    public function setFias(?string $fias): DeliveryCostRequest
    {
        $this->fias = $fias;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKladr(): ?string
    {
        return $this->kladr;
    }

    /**
     * @param string|null $kladr
     *
     * @return DeliveryCostRequest
     */
    public function setKladr(?string $kladr): DeliveryCostRequest
    {
        $this->kladr = $kladr;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPvzCode(): ?string
    {
        return $this->pvzCode;
    }

    /**
     * @param string|null $pvzCode
     *
     * @return DeliveryCostRequest
     */
    public function setPvzCode(?string $pvzCode): DeliveryCostRequest
    {
        $this->pvzCode = $pvzCode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCdekCityId(): ?int
    {
        return $this->cdekCityId;
    }

    /**
     * @param int|null $cdekCityId
     *
     * @return DeliveryCostRequest
     */
    public function setCdekCityId(?int $cdekCityId): DeliveryCostRequest
    {
        $this->cdekCityId = $cdekCityId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOblName(): ?string
    {
        return $this->oblName;
    }

    /**
     * @param string|null $oblName
     *
     * @return DeliveryCostRequest
     */
    public function setOblName(?string $oblName): DeliveryCostRequest
    {
        $this->oblName = $oblName;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     *
     * @return DeliveryCostRequest
     */
    public function setWeight(?int $weight): DeliveryCostRequest
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     *
     * @return DeliveryCostRequest
     */
    public function setPrice(?int $price): DeliveryCostRequest
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getInshprice(): ?int
    {
        return $this->inshprice;
    }

    /**
     * @param int|null $inshprice
     *
     * @return DeliveryCostRequest
     */
    public function setInshprice(?int $inshprice): DeliveryCostRequest
    {
        $this->inshprice = $inshprice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCashServices(): ?string
    {
        return $this->cashServices;
    }

    /**
     * @param string|null $cashServices
     *
     * @return DeliveryCostRequest
     */
    public function setCashServices(?string $cashServices): DeliveryCostRequest
    {
        $this->cashServices = $cashServices;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     *
     * @return DeliveryCostRequest
     */
    public function setLength(?int $length): DeliveryCostRequest
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int|null $width
     *
     * @return DeliveryCostRequest
     */
    public function setWidth(?int $width): DeliveryCostRequest
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     *
     * @return DeliveryCostRequest
     */
    public function setHeight(?int $height): DeliveryCostRequest
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeDelivery(): ?string
    {
        return $this->typeDelivery;
    }

    /**
     * @param string|null $typeDelivery
     *
     * @return DeliveryCostRequest
     */
    public function setTypeDelivery(?string $typeDelivery): DeliveryCostRequest
    {
        $this->typeDelivery = $typeDelivery;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWithoutTax(): ?string
    {
        return $this->withoutTax;
    }

    /**
     * @param string|null $withoutTax
     *
     * @return DeliveryCostRequest
     */
    public function setWithoutTax(?string $withoutTax): DeliveryCostRequest
    {
        $this->withoutTax = $withoutTax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOutput(): ?string
    {
        return $this->output;
    }

    /**
     * @param string|null $output
     *
     * @return DeliveryCostRequest
     */
    public function setOutput(?string $output): DeliveryCostRequest
    {
        $this->output = $output;
        return $this;
    }
}
