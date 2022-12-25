<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\IntervalsResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос интервалов доставки
 *
 * @see https://api.dalli-service.com/v1/doc/intervals
 * @JMS\XmlRoot("intervals")
 */
class IntervalsRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = IntervalsResponse::class;
    private ?int $zone;
    private ?int $service;

    public function __construct(?int $zone = null, ?int $service = null)
    {
        $this->service = $service;
        $this->zone = $zone;
    }

    /**
     * @return int|null
     */
    public function getZone(): ?int
    {
        return $this->zone;
    }

    /**
     * @return int|null
     */
    public function getService(): ?int
    {
        return $this->service;
    }
}
