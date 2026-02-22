<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для грузоместа
 * Для расчета стоимости многоместных заказов.
 * При заполнении контейнера игнорируются основные элементы weight, length, width и height
 *
 * https://api.dalli-service.com/doc/v1/deliverycost
 * @JMS\XmlRoot("package")
 */
class PackageDeliveryCost
{
    use Fillable;

    /**
     * Масса места в кг
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private ?float $weight = null;

    /**
     * Длина в см (необязательный)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private ?float $length = null;

    /**
     * Ширина в см (необязательный)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private ?float $width = null;

    /**
     * Высота в см (необязательный)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private ?float $height = null;

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @return float|null
     */
    public function getLength(): ?float
    {
        return $this->length;
    }

    /**
     * @return float|null
     */
    public function getWidth(): ?float
    {
        return $this->width;
    }

    /**
     * @return float|null
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): PackageDeliveryCost
    {
        $this->height = $height;
        return $this;
    }

    public function setWidth(?float $width): PackageDeliveryCost
    {
        $this->width = $width;
        return $this;
    }

    public function setLength(?float $length): PackageDeliveryCost
    {
        $this->length = $length;
        return $this;
    }

    public function setWeight(?float $weight): PackageDeliveryCost
    {
        $this->weight = $weight;
        return $this;
    }
}
