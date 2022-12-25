<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель с информаций о курьере
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("courier")
 */
class Courier
{
    use Fillable;

    /**
     * Уникальный код курьера
     * @JMS\Type("string")
     */
    private string $code;

    /**
     * Телефон курьера
     * @JMS\Type("string")
     */
    private ?string $phone = null;

    /**
     * Ф.И.О. курьера
     * @JMS\Type("string")
     */
    private string $name;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
