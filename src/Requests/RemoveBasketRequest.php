<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\RemoveBasketResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на удаление заказа из корзины
 *
 * @see https://api.dalli-service.com/v1/doc/removebasket
 * @JMS\XmlRoot("removebasket")
 */
class RemoveBasketRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = RemoveBasketResponse::class;

    /**
     * Штрих-код заказа в системе Dalli
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private ?string $barcode = null;

    /**
     * Номер заявки в учетной системе ИМ (обязательный атрибут)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("number")
     */
    private ?string $number = null;

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string|null $barcode
     *
     * @return RemoveBasketRequest
     */
    public function setBarcode(?string $barcode): RemoveBasketRequest
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     *
     * @return RemoveBasketRequest
     */
    public function setNumber(?string $number): RemoveBasketRequest
    {
        $this->number = $number;
        return $this;
    }
}
