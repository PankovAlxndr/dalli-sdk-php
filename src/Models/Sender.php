<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Контейнер информации об отправителе
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("sender")
 */
class Sender
{
    use Fillable;

    /**
     * Контактное лицо отправителя
     * @see Receiver::$person
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("company")
     */
    private ?string $company = null;

    /**
     * Город отправителя
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("town")
     *
     * @deprecated deprecated since version 1.4.0
     */
    private ?string $town = null;

    /**
     * Адрес отправителя
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("address")
     */
    private ?string $address = null;

    /**
     * Контактное лицо отправителя
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("person")
     */
    private ?string $person = null;

    /**
     * Телефон
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("phone")
     */
    private ?string $phone = null;

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @return string|null
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getPerson(): ?string
    {
        return $this->person;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
