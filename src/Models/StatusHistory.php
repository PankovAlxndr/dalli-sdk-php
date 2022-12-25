<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель контейнера со статусами доставки (хронология)
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @see \DalliSDK\Models\Status
 * @JMS\XmlRoot("statushistory")
 *
 * @template-implements \IteratorAggregate<int, Status>
 */
class StatusHistory implements \IteratorAggregate
{
    use Fillable;

    /**
     * @JMS\Type("array<DalliSDK\Models\Status>")
     * @JMS\XmlList(inline = true, entry = "status")
     * @var Status[]
     */
    private array $statuses;

    /**
     * @return Status[]
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    /**
     * @return \Traversable|Status[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getStatuses());
    }
}
