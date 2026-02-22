<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\DateIntervals;
use JMS\Serializer\Annotation as JMS;

/**
 * Ответ на IntervalsRequest при output=dates
 *
 * @JMS\XmlRoot("dates")
 *
 * @template-implements \IteratorAggregate<int, DateIntervals>
 */
class IntervalsDatesResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Количество дат
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $count = null;

    /**
     * @JMS\Type("array<DalliSDK\Models\DateIntervals>")
     * @JMS\XmlList(inline = true, entry = "date")
     * @var DateIntervals[]
     */
    private array $items = [];

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return DateIntervals[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }
}
