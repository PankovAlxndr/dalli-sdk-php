<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\OrderResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запроса создания заявки через Почту России
 *
 * @see https://api.dalli-service.com/v1/doc/rupost
 * @JMS\XmlRoot("rupostcreate")
 *
 * @template-implements \IteratorAggregate<int, OrderResponse>
 */
class RuPostResponse implements ResponseInterface, \IteratorAggregate
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
