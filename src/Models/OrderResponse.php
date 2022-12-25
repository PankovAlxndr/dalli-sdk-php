<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Models\Responses\Error;
use DalliSDK\Models\Responses\Success;
use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для мапинга ответа от https://api.dalli-service.com/v1/doc/createbasket
 *
 * @JMS\XmlRoot("order")
 */
class OrderResponse
{
    use Fillable;

    /**
     * Номер заявки в учетной системе ИМ (обязательный атрибут)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("number")
     */
    private string $number;

    /**
     * Штрих-код заказа в системе Dalli
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private ?string $barcode = null;


    /**
     * Если запрос был успешный, то ответ мапится сюда
     *
     * @JMS\Type("DalliSDK\Models\Responses\Success")
     * @JMS\SerializedName("success")
     */
    private ?Success $success = null;

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
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @return Success|null
     */
    public function getSuccess(): ?Success
    {
        return $this->success;
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
