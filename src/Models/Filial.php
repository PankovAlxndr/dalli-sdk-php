<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для филиалов компании Dalli
 *
 * @see https://api.dalli-service.com/v1/doc/filials
 * @JMS\XmlRoot("filials")
 */
class Filial
{
    use Fillable;

    /**
     * Код филиала
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("code")
     */
    private int $code;

    /**
     * Наименование
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    private string $name;

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
