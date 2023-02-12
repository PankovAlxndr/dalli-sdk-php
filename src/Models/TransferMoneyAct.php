<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для акта передачи денег
 *
 * @see https://api.dalli-service.com/v1/doc/moneyTransfers
 *
 * @JMS\XmlRoot("act")
 *
 * @template-implements \IteratorAggregate<int, OrderTransferMoney>
 */
class TransferMoneyAct implements \IteratorAggregate
{
    use Fillable;

    /**
     * Номер акта
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("number")
     */
    private string $number;

    /**
     * Дата создания акта (Y-m-d)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("DateTimeImmutable<'Y-m-d'>")
     * @JMS\SerializedName("date")
     */
    private \DateTimeImmutable $date;

    /**
     * Дата оплаты (Y-m-d)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("DateTimeImmutable<'Y-m-d'>")
     * @JMS\SerializedName("pay")
     */
    private \DateTimeImmutable $pay;

    /**
     * Размер платёжного поручения
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("price")
     */
    private float $price;

    /**
     * Номер платёжного поручения
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("payNo")
     */
    private int $payNo;

    /**
     * @JMS\Type("array<DalliSDK\Models\OrderTransferMoney>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var OrderTransferMoney[]
     */
    private array $orders;

    /**
     * @return \Traversable|OrderTransferMoney[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getOrders());
    }

    /**
     * @return OrderTransferMoney[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPay(): \DateTimeImmutable
    {
        return $this->pay;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getPayNo(): int
    {
        return $this->payNo;
    }
}
