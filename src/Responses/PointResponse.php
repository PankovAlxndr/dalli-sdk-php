<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Point;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос списка ПВЗ
 *
 * @see https://api.dalli-service.com/v1/doc/pointsInfo
 *
 * @JMS\XmlRoot("pvzlist")
 *
 * @template-implements \IteratorAggregate<int, Point>
 */
class PointResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\Point>")
     * @JMS\XmlList(inline = true, entry = "point")
     * @var Point[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Point[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Point[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
