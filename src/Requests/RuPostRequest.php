<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Models\Order;
use DalliSDK\Responses\RuPostResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на создание заявки в Почту России
 *
 * @see https://api.dalli-service.com/v1/doc/rupost
 * @JMS\XmlRoot("rupostcreate")
 */
class RuPostRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = RuPostResponse::class;

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
     * @return RuPostRequest
     */
    public function addOrder(Order $order): RuPostRequest
    {
        $this->orders[] = $order;
        return $this;
    }

    /**
     * @return RuPostRequest
     */
    public function forgetOrders(): RuPostRequest
    {
        $this->orders = [];
        return $this;
    }
}
