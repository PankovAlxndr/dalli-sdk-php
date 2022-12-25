<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель статуса заказа
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("status")
 */
class Status
{
    use Fillable;

    /**
     * Время когда был проставлен статусом с учетом часового пояса филиала
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private string $eventtime;

    /**
     * Время когда был проставлен статусом с учетом часового пояса филиала
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $createtimegmt = null;

    /**
     * Филиал, к которому относится текущий статус. Может принимать значения "Офис в Москве" и "Офис в Санкт-Петербурге"
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $eventstore = null;

    /**
     * Название статуса на русском языке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private string $title;

    /**
     * Код статуса
     *
     * @JMS\XmlValue()
     * @JMS\Type("string")
     */
    private string $code;

    /**
     * @return string
     */
    public function getEventtime(): string
    {
        return $this->eventtime;
    }

    /**
     * @return string|null
     */
    public function getCreatetimegmt(): ?string
    {
        return $this->createtimegmt;
    }


    /**
     * @return string|null
     */
    public function getEventstore(): ?string
    {
        return $this->eventstore;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
