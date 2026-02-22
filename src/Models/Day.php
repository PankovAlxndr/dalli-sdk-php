<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для запроса расписаний
 *
 * @see https://api.dalli-service.com/doc/v1/schedules
 * @JMS\XmlRoot("days")
 */
class Day
{
    use Fillable;

    /**
     * id расписания
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("id")
     */
    private int $id;

    /**
     * Названия дней недели на английском, с большой буквы.
     * Понедельник
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Monday")
     */
    private string $monday;

    /**
     * Названия дней недели на английском, с большой буквы.
     * Вторник
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Tuesday")
     */
    private string $tuesday;

    /**
     * Названия дней недели на английском, с большой буквы.
     * Среда
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Wednesday")
     */
    private string $wednesday;

    /**
     * Названия дней недели на английском, с большой буквы.
     * Четверг
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Thursday")
     */
    private string $thursday;

    /**
     * Названия дней недели на английском, с большой буквы.
     * Пятница
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Friday")
     */
    private string $friday;

    /**
     * Названия дней недели на английском, с большой буквы.
     * Суббота
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Saturday")
     */
    private string $saturday;


    /**
     * Названия дней недели на английском, с большой буквы.
     * Воскресенье
     * T означает, что в этот день недели доставка осуществляется.
     * F - не осуществляется.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("Sunday")
     */
    private string $sunday;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getMonday(): string
    {
        return $this->monday;
    }

    public function getTuesday(): string
    {
        return $this->tuesday;
    }

    public function getWednesday(): string
    {
        return $this->wednesday;
    }

    public function getThursday(): string
    {
        return $this->thursday;
    }

    public function getFriday(): string
    {
        return $this->friday;
    }

    public function getSaturday(): string
    {
        return $this->saturday;
    }

    public function getSunday(): string
    {
        return $this->sunday;
    }
}
