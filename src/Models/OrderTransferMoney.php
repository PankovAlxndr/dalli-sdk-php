<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ответа на запрос "Акты передачи денег"
 *
 * @see https://api.dalli-service.com/v1/doc/moneyTransfers
 * @JMS\XmlRoot("order")
 */
class OrderTransferMoney
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
     * Номер заявки в учетной системе ИМ (обязательный атрибут)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("number")
     */
    private string $number;

    /**
     * Дата доставки (Y-m-d)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("DateTimeImmutable<'Y-m-d'>")
     * @JMS\SerializedName("delivereddate")
     */
    private ?\DateTimeImmutable $deliveredDate = null;

    /**
     * Сумма, которую взяли с получателя
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("price")
     */
    private float $price;

    /**
     * Стоимость наших(dalli) услуг
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("service")
     */
    private float $service;

    /**
     * Сумма, которую мы переводим по этой заявке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("transfer")
     */
    private float $transfer;

    /**
     * @return string|null
     */
    public function getStrBarCode(): ?string
    {
        return $this->strBarCode;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDeliveredDate(): ?\DateTimeImmutable
    {
        return $this->deliveredDate;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getService(): float
    {
        return $this->service;
    }

    /**
     * @return float
     */
    public function getTransfer(): float
    {
        return $this->transfer;
    }
}
