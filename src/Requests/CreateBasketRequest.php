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
     * Можно указать "T", тогда заказ сразу отправится в забор, минуя корзину.
     * Идентично добавлению заказа в корзину,
     * а затем его отправки через метод sendbasket (необязательный атрибут)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("autosend")
     */
    private ?string $autoSend = null;

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

    /**
     * @return bool
     */
    public function getAutoSend(): bool
    {
        return $this->autoSend === 'T';
    }

    /**
     * @return CreateBasketRequest
     */
    public function setAutoSend(): CreateBasketRequest
    {
        $this->autoSend = "T";
        return $this;
    }

    /**
     * @return CreateBasketRequest
     */
    public function removeAutoSend(): CreateBasketRequest
    {
        $this->autoSend = null;
        return $this;
    }
}
