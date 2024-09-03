<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Filial;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос списка ПВЗ
 *
 * @see https://api.dalli-service.com/v1/doc/filials
 *
 * @JMS\XmlRoot("filials")
 *
 * @template-implements \IteratorAggregate<int, Filial>
 */
class FilialsResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Количество филиалов
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $count;

    /**
     * @JMS\Type("array<DalliSDK\Models\Filial>")
     * @JMS\XmlList(inline = true, entry = "filials")
     * @var Filial[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Filial[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Filial[]
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
