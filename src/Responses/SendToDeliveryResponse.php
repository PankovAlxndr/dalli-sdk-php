<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\OrderResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ от запроса на добавление заказов из корзины в акт
 *
 * @see https://api.dalli-service.com/v1/doc/sendbasket
 * @JMS\XmlRoot("sendbasket")
 *
 * @template-implements \IteratorAggregate<int, OrderResponse>
 */
class SendToDeliveryResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Количество обработанных записей
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $count;

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

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
