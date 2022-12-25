<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\OrderResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ от и эо является корневым элементом xml
 * внутри может быть как успешный, так и ошибочный ответ
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("basketcreate")
 *
 * @template-implements \IteratorAggregate<int, OrderResponse>
 */
class CreateBasketResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\OrderResponse>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var OrderResponse[]
     */
    private array $items = [];

    /**
     * @return \Traversable|OrderResponse[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return OrderResponse[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
