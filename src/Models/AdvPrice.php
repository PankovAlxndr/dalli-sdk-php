<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель с информацией об услуге (составная часть полной стоимости)
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("advprice")
 */
class AdvPrice
{
    use Fillable;

    /**
     * Код услуги
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $code;

    /**
     * Цена услуги
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private float $price;

    /**
     * Наименование услуги
     * @JMS\XmlValue()
     * @JMS\Type("string")
     */
    private string $name;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
