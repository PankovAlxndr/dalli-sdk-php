<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для контейнера стоимости доставки
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @see \DalliSDK\Models\AdvPrice
 * @JMS\XmlRoot("deliveryprice")
 *
 * @template-implements \IteratorAggregate<mixed, AdvPrice>
 */
class DeliveryPrice implements \IteratorAggregate
{
    use Fillable;

    /**
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     */
    private float $total;

    /**
     * @JMS\Type("array<DalliSDK\Models\AdvPrice>")
     * @JMS\XmlList(inline = true, entry = "advprice")
     * @var AdvPrice[]
     */
    private array $advPrices;

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return AdvPrice[]
     */
    public function getAdvPrices(): array
    {
        return $this->advPrices;
    }

    /**
     * @return \Traversable|AdvPrice[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getAdvPrices());
    }
}
