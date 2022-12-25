<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\OrderResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ от запроса на редактирование заявки в корзине
 *
 * @see https://api.dalli-service.com/v1/doc/editbasket
 * @JMS\XmlRoot("editbasket")
 */
class EditBasketResponse implements ResponseInterface
{
    /**
     * @JMS\Type("DalliSDK\Models\OrderResponse")
     * @JMS\SerializedName("order")
     * @var OrderResponse
     */
    private OrderResponse $item;

    /**
     * @return OrderResponse
     */
    public function getItem(): OrderResponse
    {
        return $this->item;
    }
}
