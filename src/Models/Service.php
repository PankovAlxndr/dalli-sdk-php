<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель типов доставки
 *
 * @see https://api.dalli-service.com/v1/doc/request-types-of-delivery
 * @JMS\XmlRoot("service")
 */
class Service
{
    use Fillable;

    /**
     * Код типа
     *
     * @JMS\Type("int")
     */
    public int $code;

    /**
     * Название типа
     *
     * @JMS\Type("string")
     */
    public string $name;


    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
