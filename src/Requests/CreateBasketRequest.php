<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Models\Order;
use DalliSDK\Responses\CreateBasketResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на добавление заявки в корзину
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("basketcreate")
 */
class CreateBasketRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = CreateBasketResponse::class;

    /**
     * @JMS\Type("array<DalliSDK\Models\Order>")
     * @JMS\XmlList(inline = true, entry = "order")
     * @var Order[]
     */
    private array $orders = [];

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param Order $order
     *
     * @return CreateBasketRequest
     */
    public function addOrder(Order $order): CreateBasketRequest
    {
        $this->orders[] = $order;
        return $this;
    }

    /**
     * @return CreateBasketRequest
     */
    public function forgetOrders(): CreateBasketRequest
    {
        $this->orders = [];
        return $this;
    }
}
