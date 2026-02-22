<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\IntervalsResponse;
use DalliSDK\Responses\SchedulesResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос расписаний
 *
 * @see https://api.dalli-service.com/doc/v1/schedules
 * @JMS\XmlRoot("schedules")
 */
class SchedulesRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = SchedulesResponse::class;

    /**
     * В параметр days_id вы можете указать конкретное расписание и получить только его.
     * Если параметр не заполнен, вы получите весь список расписаний.
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("days_id")
     */
    private ?int $daysId = null;

    /**
     * @param int|null $daysId
     */
    public function __construct(?int $daysId = null)
    {
        $this->daysId = $daysId;
    }

    public function getDaysId(): ?int
    {
        return $this->daysId;
    }

    public function setDaysId(?int $daysId): SchedulesRequest
    {
        $this->daysId = $daysId;
        return $this;
    }
}
