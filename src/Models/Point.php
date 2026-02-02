<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для пунктов выдачи заказов (ПВЗ)
 *
 * @see https://api.dalli-service.com/v1/doc/pointsInfo
 * @JMS\XmlRoot("point")
 */
class Point
{
    use Fillable;

    /**
     * Код ПВЗ
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("code")
     */
    private string $code;

    /**
     * Наименование
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    private string $name;

    /**
     * Регион
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("settlement")
     */
    private ?string $settlement = null;

    /**
     * Населенный пункт
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("town")
     */
    private ?string $town = null;

    /**
     * ФИАС код населённого пункта
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("fias")
     */
    private ?string $fias = null;

    /**
     * Адрес
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("address")
     */
    private string $address;

    /**
     * Отформатированный адрес
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("addressReduce")
     */
    private ?string $addressReduce = null;

    /**
     * Описание ПВЗ/Как добраться
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("description")
     */
    private ?string $description = null;

    /**
     * Почтовый индекс
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("zipcode")
     */
    private ?string $zipcode = null;

    /**
     * Если 1, ПВЗ работает только с предоплаченными заказами
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("onlyPrepaid")
     */
    private ?string $onlyPrepaid = null;

    /**
     * Если 1, принимает оплату картой
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("acquiring")
     */
    private ?string $acquiring = null;

    /**
     * Если 1, принимает оплату наличными
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("cash")
     */
    private ?string $cash = null;

    /**
     * Если 1, разрешена примерка
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("EnableFitting")
     */
    private ?string $enableFitting = null;

    /**
     * График работы в свободной форме
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("workShedule")
     */
    private ?string $workShedule = null;

    /**
     * Координаты GPS
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("GPS")
     */
    private ?string $GPS = null;

    /**
     * Телефон для справок
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("phone")
     */
    private ?string $phone = null;

    /**
     * Может принимать значения: DS, SDEK, BOXBERRY, 5POST
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("partner")
     */
    private ?string $partner = null;

    /**
     * Содержит код типа доставки
     * @see https://api.dalli-service.com/doc/v1/services
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private ?int $service = null;

    /**
     * Ограничение по весу в кг
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("weightLimit")
     */
    private ?float $weightLimit = null;

    /**
     * Ограничение по весу в кг
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("Metro")
     */
    private ?string $metro = null;

    /**
     * Название улицы
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("Street")
     */
    private ?string $street = null;

    /**
     * Дом
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("House")
     */
    private ?string $house = null;

    /**
     * Корпус
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("Structure")
     */
    private ?string $structure = null;

    /**
     * Строение
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("Housing")
     */
    private ?string $housing = null;

    /**
     *
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("Apartment")
     */
    private ?string $apartment = null;

    /**
     * Тарифная зона
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("zone")
     */
    private ?string $zone = null;

    /**
     * Если 1, то это постамат
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("postamat")
     */
    private ?string $postamat = null;

    /**
     * Дата, когда информация о ПВЗ была обновлена
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("ldtime")
     */
    private ?string $idTime = null;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSettlement(): ?string
    {
        return $this->settlement;
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
    public function getFias(): ?string
    {
        return $this->fias;
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
    public function getAddressReduce(): ?string
    {
        return $this->addressReduce;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @return string|null
     */
    public function getOnlyPrepaid(): ?string
    {
        return $this->onlyPrepaid;
    }

    /**
     * @return string|null
     */
    public function getAcquiring(): ?string
    {
        return $this->acquiring;
    }

    /**
     * @return string|null
     */
    public function getCash(): ?string
    {
        return $this->cash;
    }

    /**
     * @return string|null
     */
    public function getEnableFitting(): ?string
    {
        return $this->enableFitting;
    }

    /**
     * @return string|null
     */
    public function getWorkShedule(): ?string
    {
        return $this->workShedule;
    }

    /**
     * @return string|null
     */
    public function getGPS(): ?string
    {
        return $this->GPS;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getPartner(): ?string
    {
        return $this->partner;
    }

    /**
     * @return int|null
     */
    public function getService(): ?int
    {
        return $this->service;
    }

    /**
     * @return float|null
     */
    public function getWeightLimit(): ?float
    {
        return $this->weightLimit;
    }

    /**
     * @return string|null
     */
    public function getMetro(): ?string
    {
        return $this->metro;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }

    /**
     * @return string|null
     */
    public function getStructure(): ?string
    {
        return $this->structure;
    }

    /**
     * @return string|null
     */
    public function getHousing(): ?string
    {
        return $this->housing;
    }

    /**
     * @return string|null
     */
    public function getZone(): ?string
    {
        return $this->zone;
    }

    /**
     * @return string|null
     */
    public function getPostamat(): ?string
    {
        return $this->postamat;
    }

    /**
     * @return string|null
     */
    public function getIdTime(): ?string
    {
        return $this->idTime;
    }

    /**
     * @return string|null
     */
    public function getApartment(): ?string
    {
        return $this->apartment;
    }
}
