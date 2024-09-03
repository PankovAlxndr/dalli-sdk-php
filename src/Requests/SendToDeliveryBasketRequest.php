<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\SendToDeliveryResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на добавление заказов из корзины в акт
 *
 * @see https://api.dalli-service.com/v1/doc/sendbasket
 * @JMS\XmlRoot("sendbasket")
 */
class SendToDeliveryBasketRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = SendToDeliveryResponse::class;

    /**
     * Контейнер, который содержит штрих-коды заказов.
     * По-умолчанию все переданные заказы за сегодня (не обязательный элемент)
     *
     * @JMS\XmlList(inline = true, entry = "barcode")
     */
    private ?array $barcodes = null;

    /**
     * @return array|null
     */
    public function getBarcodes(): ?array
    {
        return $this->barcodes;
    }

    /**
     * @param array|null $barcodes
     *
     * @return SendToDeliveryBasketRequest
     */
    public function setBarcodes(?array $barcodes): SendToDeliveryBasketRequest
    {
        $this->barcodes = $barcodes;
        return $this;
    }

    /**
     * @param string $barcode
     *
     * @return $this
     */
    public function addBarcode(string $barcode): SendToDeliveryBasketRequest
    {
        if ($this->barcodes === null) {
            $this->barcodes = [];
        }
        if (in_array($barcode, $this->barcodes)) {
            throw new \InvalidArgumentException("Barcode: $barcode already exists.");
        }
        $this->barcodes[] = $barcode;
        return $this;
    }
}
