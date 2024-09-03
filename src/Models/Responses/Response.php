<?php

declare(strict_types=1);

namespace DalliSDK\Models\Responses;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ответа на запросы, сюда мапятся стандартные ответы
 *
 * @see https://api.dalli-service.com/v1/doc/cancelOrder
 * @JMS\XmlRoot("response")
 */
class Response
{
    use Fillable;

    /**
     * Флаг наличия ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("error")
     */
    private string $error;

    /**
     * Код ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private ?string $barcode = null;

    /**
     * Сообщение об ошибке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("message")
     */
    private string $message;

    /**
     * @return bool
     */
    public function getError(): bool
    {
        return (bool)$this->error;
    }

    /**
     * @return ?string
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @return ?string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
