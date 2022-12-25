<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\OrderResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос удаление корзины
 *
 * @see https://api.dalli-service.com/v1/doc/removebasket
 * @JMS\XmlRoot("removebasket")
 */
class RemoveBasketResponse implements ResponseInterface
{
    /**
     * Количество удаленных записей или 0 в случае, если ничего не удалено.
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private int $removed;

    /**
     * @return int
     */
    public function getRemoved(): int
    {
        return $this->removed;
    }
}
