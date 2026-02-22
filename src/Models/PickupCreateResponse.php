<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Models\Responses\Error;
use DalliSDK\Models\Responses\Success;
use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для мапинга ответа от https://api.dalli-service.com/doc/v1/pickupcreate
 *
 * @JMS\XmlRoot("pickup")
 */
class PickupCreateResponse
{
    use Fillable;

    /**
     * Код точки забора
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("code")
     */
    private int $code;

    /**
     * Если запрос был успешный, то ответ мапится сюда
     *
     * @JMS\Type("array<DalliSDK\Models\Responses\Success>")
     * @JMS\XmlList(inline = true, entry = "success")
     * @var Success[]
     */
    private ?array $success = null;

    /**
     * Если запрос был с ошибкой, то ответ мапится сюда
     *
     * @JMS\Type("array<DalliSDK\Models\Responses\Error>")
     * @JMS\XmlList(inline = true, entry = "error")
     * @var Error[]
     *
     */
    private ?array $errors = null;

        /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return Success[]|null
     */
    public function getSuccess(): ?array
    {
        return $this->success;
    }

    /**
     * @return Error[]|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
