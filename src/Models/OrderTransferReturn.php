<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ответа на запрос "Акты возврата"
 *
 * @see https://api.dalli-service.com/v1/doc/returnTransfers
 * @JMS\XmlRoot("order")
 */
class OrderTransferReturn
{
    use Fillable;

    /**
     * Код заявки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("acode")
     */
    private string $aCode;

    /**
     * Номер заказа в системе им
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("number")
     */
    private string $number;

    /**
     * Штрих-код заявки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private string $barcode;


    /**
     * Дата доставки (Y-m-d)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("DateTimeImmutable<'Y-m-d'>")
     * @JMS\SerializedName("delivereddate")
     */
    private ?\DateTimeImmutable $deliveredDate = null;

    /**
     * Время доставки (H:i:s)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("deliveredtime")
     */
    private ?string $deliveredTime = null;

    /**
     * Информация о доставке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("deliveredto")
     */
    private ?string $deliveredTo = null;

    /**
     * Количество товара к возврату
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("returnQty")
     */
    private int $returnQty;


    /**
     * Название товара
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("ProductName")
     */
    private string $productName;

    /**
     * Код Честный Знак
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("governmentCode")
     */
    private ?string $governmentCode = null;

    /**
     * Штрих-код товара
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("ClientBarCode")
     */
    private ?string $clientBarCode = null;

    /**
     * @return string
     */
    public function getACode(): string
    {
        return $this->aCode;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
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
     * @return string|null
     */
    public function getDeliveredTime(): ?string
    {
        return $this->deliveredTime;
    }

    /**
     * @return string|null
     */
    public function getDeliveredTo(): ?string
    {
        return $this->deliveredTo;
    }

    /**
     * @return int
     */
    public function getReturnQty(): int
    {
        return $this->returnQty;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return string|null
     */
    public function getGovernmentCode(): ?string
    {
        return $this->governmentCode;
    }

    /**
     * @return string|null
     */
    public function getClientBarCode(): ?string
    {
        return $this->clientBarCode;
    }
}
