<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Interval;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос получение интервалов
 *
 * @see https://api.dalli-service.com/v1/doc/intervals
 * @JMS\XmlRoot("intervals")
 *
 * @template-implements \IteratorAggregate<int, Interval>
 */
class IntervalsResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Количество интервалов (атрибут count у <intervals>)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $count = null;

    /**
     * @JMS\Type("array<DalliSDK\Models\Interval>")
     * @JMS\XmlList(inline = true, entry = "interval")
     * @var Interval[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Interval[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Interval[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getBasicType(): array
    {
        return array_filter($this->getItems(), function ($item) {
            return $item->getType() == 'basic';
        });
    }

    public function getClientType(): array
    {
        return array_filter($this->getItems(), function ($item) {
            return $item->getType() == 'client';
        });
    }

    /**
     * @return ?int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }
}
