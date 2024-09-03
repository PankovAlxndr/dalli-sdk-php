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
     * Название города, интервалы которого, вы хотите получить. Работает только для региональной доставки (service 22)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("town")
     */
    private ?string $town;

    /**
     * ФИАС города, в котором доступен интервал. Работает только для региональной доставки (service 22)
     *
     * @JMS\Type("string")
     */
    private ?string $fias = null;

    /**
     * Тип доставки, интервалы которого, вы хотите получить. (по умолчанию - внутригородская доставка)
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private ?int $service;

    /**
     * Код филиала Dalli. Можно использовать вместо города и ФИАС
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("filial")
     */
    private ?int $filial = null;

    /**
     * Дата доставки заказа в формате yyyy-mm-dd. Используется при смене интервалов,
     * чтобы отображать актуальные интервалы для выбранной даты доставки.
     * (по умолчанию - сегодня для экспресс, завтра для остальных)
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("date")
     */
    private ?\DateTimeInterface $date;

    public function __construct(
        ?int $zone = null,
        ?int $service = null,
        ?string $town = null,
        ?string $fias = null,
        ?\DateTimeInterface $date = null,
        ?int $filial = null
    ) {
        $this->service = $service;
        $this->zone = $zone;
        $this->town = $town;
        $this->fias = $fias;
        $this->date = $date;
        $this->filial = $filial;
    }

    /**
     * @return int|null
     */
    public function getZone(): ?int
    {
        return $this->zone;
    }

    /**
     * @return string|null
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @return string|null
     */
    public function getFias(): ?string
    {
        return $this->fias;
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

    public function getFilial(): ?int
    {
        return $this->filial;
    }
}
