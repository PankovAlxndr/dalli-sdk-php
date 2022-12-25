<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ответа на "Запрос статусов доставки"
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("order")
 */
class OrderDelivery
{
    use Fillable;

    /**
     * Номер заказа в системе учета ИМ
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("orderno")
     */
    private string $orderNo;

    /**
     * Внутренний код заказа в системе Dalli; применяется для некоторых внутренних операций
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("ordercode")
     */
    private string $orderCode;

    /**
     * Штрих-код заказа
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("givencode")
     */
    private string $givenCode;

    /**
     * Штрих-код заказа
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("awb")
     */
    private string $awb;

    /**
     * Штрих-код заказа
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private string $barcode;

    /**
     * Контейнер информации о получателе
     *
     * @JMS\Type("DalliSDK\Models\Receiver")
     * @JMS\SerializedName("receiver")
     */
    private Receiver $receiver;

    /**
     * Фактический вес заказа
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("weight")
     */
    private float $weight;

    /**
     * Кол-во мест
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("quantity")
     */
    private int $quantity;

    /**
     * Тип оплаты (CASH - наличными курьеру, CARD - картой курьеру, NO - курьер денег не берет)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("paytype")
     */
    private string $payType = 'CASH';

    /**
     * Тип доставки
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private int $service;

    /**
     * Вложение; используется для справочной информации
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("enclosure")
     */
    private ?string $enclosure = null;

    /**
     * Акт возврата
     *
     * @JMS\Type("DalliSDK\Models\Acta")
     * @JMS\SerializedName("acta")
     */
    private Acta $acta;

    /**
     * Наложенный платеж
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("price")
     */
    private float $price;

    /**
     * Объявленная ценность
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("inshprice")
     */
    private float $inshPrice;

    /**
     * Текстовое поле для внутренних нужд
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("department")
     */
    private ?string $department = null;

    /**
     * Текстовое поле для внутренних нужд
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("costcode")
     */
    private ?string $costCode = null;

    /**
     * Внешний код (используется при магистральных перевозках, межгороде, доставке через партнеров)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("outstrbarcode")
     */
    private ?string $outStrBarcode = null;

    /**
     * Комментарий получателя; дополнительная информация для курьера
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("instruction")
     */
    private ?string $instruction = null;

    /**
     * Контейнер информации о курьере
     *
     * @JMS\Type("DalliSDK\Models\Courier")
     * @JMS\SerializedName("courier")
     */
    private ?Courier $courier = null;

    /**
     * Контейнер стоимости доставки
     *
     * @JMS\Type("DalliSDK\Models\DeliveryPrice")
     * @JMS\SerializedName("deliveryprice")
     */
    private DeliveryPrice $deliveryPrice;

    /**
     * Текущий статус заказа
     *
     * @JMS\Type("DalliSDK\Models\Status")
     * @JMS\SerializedName("status")
     */
    private Status $status;

    /**
     * Контейнер хронологии изменений, содержит 1 или несколько элементов вида order->status
     *
     * @JMS\Type("DalliSDK\Models\StatusHistory")
     * @JMS\SerializedName("statushistory")
     */
    private StatusHistory $statusHistory;

    /**
     * Информация о доставке
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("deliveredto")
     */
    private ?string $deliveredTo = null;

    /**
     * Дата доставки (Y-m-d)
     *
     * @JMS\Type("DateTimeImmutable<'Y-m-d'>")
     * @JMS\SerializedName("delivereddate")
     */
    private ?\DateTimeImmutable $deliveredDate = null;

    /**
     * Время доставки (H:i:s)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("deliveredtime")
     */
    private ?string $deliveredTime = null;

    /**
     * Ссылка на чек, в атрибутах указаны поля по отдельности
     *
     * @JMS\Type("DalliSDK\Models\Receipt")
     * @JMS\SerializedName("receipt")
     */
    private ?Receipt $receipt = null;

    /**
     * Контейнер товарных позиций
     *
     * @JMS\Type("array<DalliSDK\Models\Item>")
     * @JMS\XmlList(entry = "item")
     * @JMS\SerializedName("items")
     *
     * @var Item[]
     */
    private array $items;

    /**
     * Контейнер товарных мест
     *
     * @JMS\Type("array<DalliSDK\Models\Package>")
     * @JMS\XmlList(entry = "package")
     * @JMS\SerializedName("packages")
     *
     * @var Package[]
     */
    private ?array $packages = null;

    /**
     * @return string
     */
    public function getOrderNo(): string
    {
        return $this->orderNo;
    }

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderCode;
    }

    /**
     * @return string
     */
    public function getGivenCode(): string
    {
        return $this->givenCode;
    }

    /**
     * @return string
     */
    public function getAwb(): string
    {
        return $this->awb;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return Receiver
     */
    public function getReceiver(): Receiver
    {
        return $this->receiver;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getPayType(): string
    {
        return $this->payType;
    }

    /**
     * @return int
     */
    public function getService(): int
    {
        return $this->service;
    }

    /**
     * @return string|null
     */
    public function getEnclosure(): ?string
    {
        return $this->enclosure;
    }

    /**
     * @return Acta
     */
    public function getActa(): Acta
    {
        return $this->acta;
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
    public function getInshPrice(): float
    {
        return $this->inshPrice;
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * @return string|null
     */
    public function getCostCode(): ?string
    {
        return $this->costCode;
    }

    /**
     * @return string|null
     */
    public function getOutStrBarcode(): ?string
    {
        return $this->outStrBarcode;
    }

    /**
     * @return string|null
     */
    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    /**
     * @return Courier|null
     */
    public function getCourier(): ?Courier
    {
        return $this->courier;
    }

    /**
     * @return DeliveryPrice
     */
    public function getDeliveryPrice(): DeliveryPrice
    {
        return $this->deliveryPrice;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return StatusHistory
     */
    public function getStatusHistory(): StatusHistory
    {
        return $this->statusHistory;
    }

    /**
     * @return string|null
     */
    public function getDeliveredTo(): ?string
    {
        return $this->deliveredTo;
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
     * @return Receipt|null
     */
    public function getReceipt(): ?Receipt
    {
        return $this->receipt;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array|null
     */
    public function getPackages(): ?array
    {
        return $this->packages;
    }
}
