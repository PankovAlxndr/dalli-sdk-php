<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Order;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос получение корзины
 *
 * @see https://api.dalli-service.com/v1/doc/getbasket
 * @JMS\XmlRoot("getbasket")
 *
 * @template-implements \IteratorAggregate<int, Order>
 */
class GetBasketResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Количество обработанных записей
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $count;

    /**
     * @JMS\Type("array<DalliSDK\Models\Order>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var Order[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Order[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Order[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
