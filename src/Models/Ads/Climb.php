<?php

declare(strict_types=1);

namespace DalliSDK\Models\Ads;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Услуга подъёма разгрузки (ПРР). Актуально для service 30 (КГТ)
 *
 * @see https://api.dalli-service.com/doc/v1/basketcreate
 *
 * @JMS\XmlRoot("climb")
 */
class Climb
{
    use Fillable;

    /**
     * Наличие лифта
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("type")
     */
    private ?string $type = null;

    /**
     * Этаж (актуально для stairs)
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("floor")
     */
    private ?int $floor = null;

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return Climb
     */
    public function setType(?string $type): Climb
    {
        if ($type === null) {
            $this->type = null;
            return $this;
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * @param int|null $floor
     *
     * @return Climb
     */
    public function setFloor(?int $floor): Climb
    {
        $this->floor = $floor;
        return $this;
    }
}
