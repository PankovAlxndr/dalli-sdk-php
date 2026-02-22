<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Address;
use JMS\Serializer\Annotation as JMS;

/**
 * Ответ от создания заявок на забор
 *
 * @see https://api.dalli-service.com/doc/v1/pickupcreate
 * @JMS\XmlRoot("pickupcreate")
 *
 * @template-implements \IteratorAggregate<int, \DalliSDK\Models\PickupCreateResponse>
 */
class PickupCreateResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\PickupCreateResponse>")
     * @JMS\XmlList(inline = true, entry = "pickup")
     * @var \DalliSDK\Models\PickupCreateResponse[]
     */
    private array $items = [];

    /**
     * @return \Traversable|\DalliSDK\Models\PickupCreateResponse[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return \DalliSDK\Models\PickupCreateResponse[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
