<?php

declare(strict_types=1);

namespace DalliSDK\Models\Responses;

use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ответа на запросы, сюда мапятся успешные ответы
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("success")
 */
class Success
{
    /**
     * Штрих-код заказа в системе Dalli
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private string $barcode;

    /**
     * Содержит код типа доставки
     * @see https://api.dalli-service.com/doc/v1/services
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private ?int $service = null;

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return int|null
     */
    public function getService(): ?int
    {
        return $this->service;
    }
}
