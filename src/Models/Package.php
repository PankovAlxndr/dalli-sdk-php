<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для грузоместа
 * Для получения доступа к добавлению мест обратитесь к вашему менеджеру
 * По умолчанию, данная опция недоступна
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("package")
 */
class Package
{
    use Fillable;

    /**
     * Штрих-код места (обязательный параметр)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("strbarcode")
     */
    private ?string $strBarCode;

    /**
     * Масса места в кг(необязательный)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private ?float $mass = null;

    /**
     * Название места (необязательный)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $message = null;

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
     * @return string|null
     */
    public function getStrBarCode(): ?string
    {
        return $this->strBarCode;
    }

    /**
     * @return float|null
     */
    public function getMass(): ?float
    {
        return $this->mass;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
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
}
