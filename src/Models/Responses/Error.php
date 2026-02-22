<?php

declare(strict_types=1);

namespace DalliSDK\Models\Responses;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ответа на запросы, сюда мапятся ошибки
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @JMS\XmlRoot("error")
 */
class Error
{
    use Fillable;

    /**
     * Код элемента с ошибкой
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("error")
     */
    private ?string $error = null;

    /**
     * Код ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("errorCode")
     */
    private ?int $errorCode = null;

    /**
     * Сообщение об ошибке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("errorMessage")
     */
    private ?string $errorMessage = null;

    /**
     * @return null|string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return null|int
     */
    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
