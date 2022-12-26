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

    /**
     * Зона, интервалы которой, вы хотите получить
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("zone")
     */
    private ?int $zone;

    /**
     * Тип доставки, интервалы которого, вы хотите получить. (по умолчанию - внутригородская доставка)
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private ?int $service;

    /**
     * Дата доставки заказа в формате yyyy-mm-dd. Используется при смене интервалов,
     * чтобы отображать актуальные интервалы для выбранной даты доставки.
     * (по умолчанию - сегодня для экспресс, завтра для остальных)
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("date")
     */
    private ?\DateTimeInterface $date;

    public function __construct(?int $zone = null, ?int $service = null, ?\DateTimeInterface $date = null)
    {
        $this->service = $service;
        $this->zone = $zone;
        $this->date = $date;
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

    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
}
