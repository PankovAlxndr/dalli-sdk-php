<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель получателя заказа
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("receiver")
 */
class Receiver
{
    use Fillable;

    /**
     * Контактное лицо (поддержка Dalli заказала, что это одни и то же с $person)
     * @see Receiver::$person
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("company")
     */
    private ?string $company = null;

    /**
     * Индекс
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("zipcode")
     */
    private ?string $zipCode = null;

    /**
     * Город (тег обязателен для курьерской доставки, но игнорируется для ПВЗ)
     *  Может быть:
     *       Строковым названием города в формате "Москва город"
     *       13-ти значным кодом адресного классификатора КЛАДР
     *       36-ти значным кодом адресной системы ФИАС
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("town")
     */
    private string $town;

    /**
     * Адрес (обязательный тег, если тип доставки относится к курьерской доставке)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("address")
     */
    private string $address;

    /**
     * Полный адрес одной строкой (Желательно, используется ВМЕСТО town+address)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("to")
     */
    private ?string $to = null;

    /**
     * Код пункта выдачи заказов (обязательный тег, если тип доставки относится к ПВЗ)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("pvzcode")
     */
    private ?string $pvzcode = null;

    /**
     * Контактное лицо (обязательный тег)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("person")
     */
    private string $person;

    /**
     * Телефон (обязательный тег). Так же в это поле можно добавить электронную почту получателя.
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("phone")
     */
    private string $phone;

    /**
     * Дата доставки в формате yyyy-mm-dd. Не играет роли при передаче партнёрам (обязательный тег)
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("date")
     */
    private \DateTimeInterface $date;

    /**
     * Желаемое время доставки, в формате hh:mm (обязательный тег)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_min")
     */
    private string $timeMin;

    /**
     * Желаемое время доставки, в формате hh:mm (обязательный тег)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("time_max")
     */
    private string $timeMax;

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
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getPvzcode(): ?string
    {
        return $this->pvzcode;
    }

    /**
     * @return string
     */
    public function getPerson(): string
    {
        return $this->person;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
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
     * @param string|null $company
     *
     * @return Receiver
     */
    public function setCompany(?string $company): Receiver
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @param string|null $zipCode
     *
     * @return Receiver
     */
    public function setZipCode(?string $zipCode): Receiver
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @param string $town
     *
     * @return Receiver
     */
    public function setTown(string $town): Receiver
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @param string $address
     *
     * @return Receiver
     */
    public function setAddress(string $address): Receiver
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string|null $pvzcode
     *
     * @return Receiver
     */
    public function setPvzcode(?string $pvzcode): Receiver
    {
        $this->pvzcode = $pvzcode;
        return $this;
    }

    /**
     * @param string $person
     *
     * @return Receiver
     */
    public function setPerson(string $person): Receiver
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param string $phone
     *
     * @return Receiver
     */
    public function setPhone(string $phone): Receiver
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param \DateTimeInterface $date
     *
     * @return Receiver
     */
    public function setDate(\DateTimeInterface $date): Receiver
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string $timeMin
     *
     * @return Receiver
     */
    public function setTimeMin(string $timeMin): Receiver
    {
        $this->timeMin = $timeMin;
        return $this;
    }

    /**
     * @param string $timeMax
     *
     * @return Receiver
     */
    public function setTimeMax(string $timeMax): Receiver
    {
        $this->timeMax = $timeMax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * @param string|null $to
     *
     * @return Receiver
     */
    public function setTo(?string $to): Receiver
    {
        $this->to = $to;
        return $this;
    }
}
