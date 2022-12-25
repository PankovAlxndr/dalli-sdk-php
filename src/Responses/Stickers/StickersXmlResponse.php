<?php

declare(strict_types=1);

namespace DalliSDK\Responses\Stickers;

use DalliSDK\Models\StickerOrder;
use DalliSDK\Responses\ResponseInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("stickers")
 *
 * @template-implements \IteratorAggregate<int, StickerOrder>
 */
class StickersXmlResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\StickerOrder>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var StickerOrder[]
     */
    private array $items = [];

    /**
     * @return \Traversable|StickerOrder[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getItems());
    }

    /**
     * @return StickerOrder[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
