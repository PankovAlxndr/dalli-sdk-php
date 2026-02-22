<?php

declare(strict_types=1);

namespace DalliSDK\Models\Ads;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Контейнер дополнительных услуг <ads>...</ads>
 *
 * @see https://api.dalli-service.com/doc/v1/basketcreate
 *
 * <ads>
 *   <climb .../>
 *   <another-service .../>
 * </ads>
 *
 * @JMS\XmlRoot("ads")
 */
class Ads
{
    use Fillable;

    /**
     * Услуга подъёма разгрузки (ПРР). Актуально для service 30 (КГТ)
     *
     * @JMS\Type("DalliSDK\Models\Ads\Climb")
     * @JMS\SerializedName("climb")
     */
    private ?Climb $climb = null;

    /**
     * Опционально ловим неизвестные/новые элементы внутри <ads>,
     * чтобы десериализация не ломалась при расширении API.
     *
     * @JMS\XmlAny()
     * @var array<mixed>|null
     */
    private ?array $any = null;

    public function getClimb(): ?Climb
    {
        return $this->climb;
    }

    public function setClimb(?Climb $climb): Ads
    {
        $this->climb = $climb;
        return $this;
    }

    /**
     * @return array<mixed>|null
     */
    public function getAny(): ?array
    {
        return $this->any;
    }
}
