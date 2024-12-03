<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель стоимости доставки для соответствующего запроса калькуляции
 *
 * @see https://api.dalli-service.com/v1/doc/cost-delivery
 * @JMS\XmlRoot("price")
 */
class Price
{
    use Fillable;

    /**
     * Тип тарифа (для Почты России)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $type = null;

    /**
     * Режим доставки (тип услуги) передается код из соответствующего справочника
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $service = null;

    /**
     * Стоимость доставки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $price = null;

    /**
     * Срок доставки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("delivery_period")
     */
    private ?string $deliveryPeriod = null;

    /**
     * Дополнительная информация о доставке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $msg = null;

    /**
     * Зона, в которую попадает адрес
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $zone = null;

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getService(): ?int
    {
        return $this->service;
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
     * @return string|null
     */
    public function getZone(): ?string
    {
        return $this->zone;
    }
}
