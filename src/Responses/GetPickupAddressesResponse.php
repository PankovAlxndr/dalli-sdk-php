<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Address;
use JMS\Serializer\Annotation as JMS;

/**
 * Получение адресов забора
 *
 * @see https://api.dalli-service.com/doc/v1/getPickupAddresses
 * @JMS\XmlRoot("getPickupAddresses")
 *
 * @template-implements \IteratorAggregate<int, Address>
 */
class GetPickupAddressesResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * Атрибут, указывающий количество найденных адресов
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $count;

    /**
     * @return int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @JMS\Type("array<DalliSDK\Models\Address>")
     * @JMS\XmlList(inline="true", entry = "address")
     * @var Address[]
     */
    private array $address = [];

    /**
     * @return \Traversable|Address[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Address[]
     */
    public function getItems(): array
    {
        return $this->address;
    }
}
