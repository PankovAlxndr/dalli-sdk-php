<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для акта возврата
 *
 * @see https://api.dalli-service.com/v1/doc/returnTransfers
 *
 * @JMS\XmlRoot("act")
 *
 * @template-implements \IteratorAggregate<int, OrderTransferReturn>
 */
class TransferReturnAct implements \IteratorAggregate
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
     * @JMS\SerializedName("actDate")
     */
    private \DateTimeImmutable $actDate;

    /**
     * Комментарий к акту
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("actMessage")
     */
    private ?string $actMessage = null;

    /**
     * @JMS\Type("array<DalliSDK\Models\OrderTransferReturn>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var OrderTransferReturn[]
     */
    private array $orders;

    /**
     * @return \Traversable|OrderTransferReturn[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getOrders());
    }

    /**
     * @return OrderTransferReturn[]
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
     * @return null|string
     */
    public function getActMessage(): ?string
    {
        return $this->actMessage;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function geActDate(): \DateTimeImmutable
    {
        return $this->actDate;
    }
}
