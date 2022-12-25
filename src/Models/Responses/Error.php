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
    private string $error;

    /**
     * Код ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("errorCode")
     */
    private int $errorCode;

    /**
     * Сообщение об ошибке
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("errorMessage")
     */
    private string $errorMessage;

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
