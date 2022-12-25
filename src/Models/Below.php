<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для границы стоимости настроек дифференциальной стоимости доставки
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("below")
 */
class Below
{
    use Fillable;

    /**
     * Граница стоимости выкупаемого
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("below_sum")
     */
    private float $belowSum;

    /**
     * Стоимость выкупаемого до соответствующей границы
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private float $price;

    /**
     * @return float
     */
    public function getBelowSum(): float
    {
        return $this->belowSum;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $belowSum
     *
     * @return Below
     */
    public function setBelowSum(float $belowSum): Below
    {
        $this->belowSum = $belowSum;
        return $this;
    }

    /**
     * @param float $price
     *
     * @return Below
     */
    public function setPrice(float $price): Below
    {
        $this->price = $price;
        return $this;
    }
}
