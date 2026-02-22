<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use DalliSDK\Models\Day;
use DalliSDK\Models\Interval;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос расписаний
 *
 * @see https://api.dalli-service.com/doc/v1/schedules
 * @JMS\XmlRoot("schedules")
 *
 * @template-implements \IteratorAggregate<int, Interval>
 */
class SchedulesResponse implements ResponseInterface
{
    /**
     * @JMS\Type("DalliSDK\Models\Day")
     * @JMS\SerializedName("days")
     */
    private Day $days;

    public function getDays(): Day
    {
        return $this->days;
    }
}
