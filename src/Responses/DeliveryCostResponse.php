<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Price;
use JMS\Serializer\Annotation as JMS;

/**
 * Предварительный расчет стоимости
 *
 * @see https://api.dalli-service.com/v1/doc/cost-delivery
 * @JMS\XmlRoot("deliverycost")
 *
 * @template-implements \IteratorAggregate<int, Price>
 */
class DeliveryCostResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Название компании, которая осуществляет доставку
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $partner = null;

    /**
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("townto")
     */
    private ?string $townTo = null;

    /**
     * Зона, в которую попадает адрес
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $zone = null;

    /**
     * Стоимость доставки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $price = null;

    /**
     * Дополнительная информация о доставке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("delivery_period")
     */
    private ?string $deliveryPeriod = null;

    /**
     * Сообщение
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $msg = null;

    /**
     * Код ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $error = null;

    /**
     * Текст ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("errormsg")
     */
    private ?string $errorMsg = null;

    /**
     * @JMS\Type("array<DalliSDK\Models\Price>")
     * @JMS\XmlList(inline = true, entry = "price")
     * @var Price[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Price[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Price[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string|null
     */
    public function getPartner(): ?string
    {
        return $this->partner;
    }

    /**
     * @return string|null
     */
    public function getTownTo(): ?string
    {
        return $this->townTo;
    }

    /**
     * @return string|null
     */
    public function getZone(): ?string
    {
        return $this->zone;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return string|null
     */
    public function getDeliveryPeriod(): ?string
    {
        return $this->deliveryPeriod;
    }

    /**
     * @return string|null
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }

    /**
     * @return int|null
     */
    public function getError(): ?int
    {
        return $this->error;
    }

    /**
     * @return string|null
     */
    public function getErrorMsg(): ?string
    {
        return $this->errorMsg;
    }
}
