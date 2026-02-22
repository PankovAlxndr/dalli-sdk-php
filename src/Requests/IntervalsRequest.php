<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\IntervalsDatesResponse;
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

    public const OUTPUT_INTERVALS = 'intervals';
    public const OUTPUT_DATES = 'dates';

    public function getResponseClass(): string
    {
        if ($this->output === self::OUTPUT_DATES) {
            return IntervalsDatesResponse::class;
        }

        return parent::getResponseClass();
    }
    /**
     * Полный адрес доставки, для которого вы хотите получить интервал.
     * Рекомендуем использовать его для более точного определения доступных интервалов
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("address")
     */
    private ?string $address;

    /**
     * Принимает значения "T" и "F" (по умолчанию).
     * Если "T", то вы получите ошибку при некорректном заполнении города, ФИАС или адреса,
     * а не все доступные интервалы всех регионов
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("strict")
     */
    private string $strict = 'F';

    /**
     * Может принимать значения intervals (по умолчанию) и dates.
     * Во втором случае, вы получите список дат, на которые можно передать заказ,
     * и список доступных интервалов для каждой из них.
     * Для этого формата вывода можно использовать все параметры метода, описанные ниже, кроме даты
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("output")
     */
    private string $output = self::OUTPUT_INTERVALS;

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
        ?int $filial = null,
        ?string $address = null,
        ?string $output = 'intervals',
        ?string $strict = 'F'
    ) {
        $this->service = $service;
        $this->zone = $zone;
        $this->town = $town;
        $this->fias = $fias;
        $this->date = $date;
        $this->filial = $filial;
        $this->address = $address;
        $this->output = $output;
        $this->strict = $strict;
    }

    public function setAddress(?string $address): IntervalsRequest
    {
        $this->address = $address;
        return $this;
    }

    public function setStrict(string $strict): IntervalsRequest
    {
        $this->strict = $strict;
        return $this;
    }

    public function setOutput(string $output): IntervalsRequest
    {
        $this->output = $output;
        return $this;
    }

    public function setZone(?int $zone): IntervalsRequest
    {
        $this->zone = $zone;
        return $this;
    }

    public function setTown(?string $town): IntervalsRequest
    {
        $this->town = $town;
        return $this;
    }

    public function setFias(?string $fias): IntervalsRequest
    {
        $this->fias = $fias;
        return $this;
    }

    public function setService(?int $service): IntervalsRequest
    {
        $this->service = $service;
        return $this;
    }

    public function setFilial(?int $filial): IntervalsRequest
    {
        $this->filial = $filial;
        return $this;
    }

    public function setDate(?\DateTimeInterface $date): IntervalsRequest
    {
        $this->date = $date;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
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

    public function getStrict(): string
    {
        return $this->strict;
    }

    public function getOutput(): string
    {
        return $this->output;
    }
}
