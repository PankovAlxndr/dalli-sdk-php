<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\OrderDelivery;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос статусов доставки
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("statusreq")
 *
 * @template-implements \IteratorAggregate<int, OrderDelivery>
 */
class OrderDeliveryStatusResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\OrderDelivery>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var OrderDelivery[]
     */
    private array $items = [];

    /**
     * @return \Traversable|OrderDelivery[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return OrderDelivery[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
