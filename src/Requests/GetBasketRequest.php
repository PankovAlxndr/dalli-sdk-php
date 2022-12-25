<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\GetBasketResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на получение списка заказов в корзине
 *
 * @see https://api.dalli-service.com/v1/doc/getbasket
 * @JMS\XmlRoot("getbasket")
 */
class GetBasketRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = GetBasketResponse::class;

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
     * @return GetBasketRequest
     */
    public function setBarcode(?string $barcode): GetBasketRequest
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
     * @return GetBasketRequest
     */
    public function setNumber(?string $number): GetBasketRequest
    {
        $this->number = $number;
        return $this;
    }
}
