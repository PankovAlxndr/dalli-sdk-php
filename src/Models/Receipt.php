<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель с информацией о чеке
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("receipt")
 */
class Receipt
{
    use Fillable;

    /**
     * Дата пробития чека
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("date_beg")
     */
    private string $dateBeg;

    /**
     * ИНН
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private string $inn;

    /**
     * Номер фискального накопителя
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("fnSn")
     */
    private string $fnSn;

    /**
     * Сумма чека
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private string $summ;

    /**
     * Фискальный номер чека
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("fdNum")
     */
    private string $fdNum;

    /**
     * Регистрационный номер кассы
     *
     * @JMS\XmlAttribute()\
     * @JMS\Type("string")
     * @JMS\SerializedName("kktNum")
     */
    private string $kktNum;

    /**
     * Доменное имя ОФД
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("ofdUrl")
     */
    private string $ofdUrl;

    /**
     * Фискальный признак документа
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("fdValue")
     */
    private string $fdValue;

    /**
     * @JMS\XmlValue()
     * @JMS\Type("string")
     */
    private string $url;

    /**
     * @return string
     */
    public function getDateBeg(): string
    {
        return $this->dateBeg;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getFnSn(): string
    {
        return $this->fnSn;
    }

    /**
     * @return string
     */
    public function getSumm(): string
    {
        return $this->summ;
    }

    /**
     * @return string
     */
    public function getFdNum(): string
    {
        return $this->fdNum;
    }

    /**
     * @return string
     */
    public function getKktNum(): string
    {
        return $this->kktNum;
    }

    /**
     * @return string
     */
    public function getOfdUrl(): string
    {
        return $this->ofdUrl;
    }

    /**
     * @return string
     */
    public function getFdValue(): string
    {
        return $this->fdValue;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
