<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\CancelOrderResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос на отмену заявки
 *
 * @see https://api.dalli-service.com/v1/doc/cancelOrder
 * @JMS\XmlRoot("cancelorder")
 */
class CancelOrderRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = CancelOrderResponse::class;

    /**
     * Контейнер, который содержит штрих-коды заказов.
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
     * @return CancelOrderRequest
     */
    public function setBarcodes(?array $barcodes): CancelOrderRequest
    {
        $this->barcodes = $barcodes;
        return $this;
    }
}
