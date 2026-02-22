<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Responses\IntervalsResponse;
use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Элемент <date> в ответе output=dates
 *
 * Пример:
 * <date value="2025-10-13">
 *   <intervals count="2">...</intervals>
 * </date>
 *
 * @see https://api.dalli-service.com/v1/doc/intervals
 *
 * @JMS\XmlRoot("date")
 */
class DateIntervals
{
    use Fillable;

    /**
     * Дата
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    private ?\DateTimeInterface $value = null;

    /**
     * Вложенный контейнер интервалов для конкретной даты
     *
     * @JMS\Type("DalliSDK\Responses\IntervalsResponse")
     * @JMS\SerializedName("intervals")
     */
    private ?IntervalsResponse $intervals  = null;

    /**
     * @return \DateTimeInterface|null
     */
    public function getValue(): ?\DateTimeInterface
    {
        return $this->value;
    }

    /**
     * @return IntervalsResponse|null
     */
    public function getIntervals(): ?IntervalsResponse
    {
        return $this->intervals;
    }
}
