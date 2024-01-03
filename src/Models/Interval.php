<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для мапинга доступных интервалов для доставки через Dalli
 *
 * @see https://api.dalli-service.com/v1/doc/intervals
 * @JMS\XmlRoot("interval")
 */
class Interval
{
    use Fillable;

    /**
     * Начало интервала (например 14 - значит начиная с 14:00)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_min")
     */
    private string $timeMin;

    /**
     * Конец интервала (например 22 - значит начиная до 22:00)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_max")
     */
    private string $timeMax;

    /**
     * Атрибут указывающий тип интервала. Может принимать значения:
     *   basic - доступный для всех интервал
     *   client - особый интервал, доступный только вам
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private string $type;

    /**
     * Атрибут указывающий зону, в которой доступен интервал
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $zone;

    /**
     * Атрибут указывающий название города, в котором доступен интервал. Работает только для региональной доставки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $town = null;

    /**
     * Атрибут указывающий ФИАС города, в котором доступен интервал. Работает только для региональной доставки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $fias = null;

    /**
     * Атрибут указывающий тип доставки, в котором доступен интервал
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $service;

    /**
     * @return string
     */
    public function getTimeMin(): string
    {
        return $this->timeMin;
    }

    /**
     * @return string
     */
    public function getTimeMax(): string
    {
        return $this->timeMax;
    }

    /**
     * @return int
     */
    public function getZone(): int
    {
        return $this->zone;
    }

    /**
     * @return null|string
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @return null|string
     */
    public function getFias(): ?string
    {
        return $this->fias;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getService(): int
    {
        return $this->service;
    }
}
