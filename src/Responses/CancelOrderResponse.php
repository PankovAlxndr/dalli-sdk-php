<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Responses\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ от запроса на отмену заявки
 *
 * @see https://api.dalli-service.com/v1/doc/cancelOrder
 * @JMS\XmlRoot("cancelorder")
 *
 * @template-implements \IteratorAggregate<int, Response>
 */
class CancelOrderResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\Responses\Response>")
     * @JMS\XmlList(inline = true, entry = "response")
     * @var Response[]
     */
    private array $items = [];

    /**
     * @return \Traversable|Response[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return Response[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
