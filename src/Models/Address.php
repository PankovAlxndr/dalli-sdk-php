<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для адресов забора
 *
 * @see https://api.dalli-service.com/doc/v1/getPickupAddresses
 * @JMS\XmlRoot("address")
 */
class Address
{
    use Fillable;

    /**
     * Атрибут с кодом точки забора. Должен быть уникальным в рамках одного клиента
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("code")
     */
    private int $code;

    /**
     * Активность. Если 1 - значит можно оформлять забор, если 0 - данная точка забора недоступна
     * @JMS\Type("int")
     */
    private int $active;

    /**
     * Адрес точки забора
     * @JMS\Type("string")
     */
    private string $address;

    /**
     * Начало интервала забор
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_min")
     */
    private string $timeMin;


    /**
     * Конец интервала забора
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_max")
     */
    private string $timeMax;

    /**
     * Телефон точки забора
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("phone")
     */
    private string $phone;

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

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
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
