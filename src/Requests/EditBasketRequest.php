<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Models\Order;
use DalliSDK\Responses\EditBasketResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Редактирование заявки в корзине
 *
 * @see https://api.dalli-service.com/v1/doc/editbasket
 * @JMS\XmlRoot("editbasket")
 */
class EditBasketRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = EditBasketResponse::class;

    /**
     * @JMS\Type("DalliSDK\Models\Order")
     */
    private Order $order;

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     *
     * @return EditBasketRequest
     */
    public function setOrder(Order $order): EditBasketRequest
    {
        $this->order = $order;
        return $this;
    }
}
