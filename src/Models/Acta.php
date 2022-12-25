<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель с информацией об акте возврата
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("acta")
 */
class Acta
{
    use Fillable;

    /**
     * Дата акта
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private ?string $date = null;

    /**
     * Название акта
     *
     * @JMS\XmlValue
     * @JMS\Type("string")
     */
    private ?string $name = null;

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @JMS\PostDeserialize
     */
    private function postDeserialize(): void
    {
        $this->date = ($this->date !== '') ? $this->date : null;
        $this->name = ($this->name !== '') ? $this->name : null;
    }
}
