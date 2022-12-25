<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Price;
use DalliSDK\Models\Service;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос получения типов доставки
 *
 * @see https://api.dalli-service.com/v1/doc/request-types-of-delivery
 * @JMS\XmlRoot("services")
 *
 * @template-implements \IteratorAggregate<int, Service>
 */
class ServicesResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\Service>")
     * @JMS\XmlList(inline = true, entry = "service")
     * @var Service[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Service[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Service[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return Service|bool
     */
    public function filterByServiceCode(int $code)
    {
        return current(array_filter($this->getItems(), function ($item) use ($code) {
            return $item->getCode() == $code;
        }));
    }
}
