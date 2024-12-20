<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\PointResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос списка ПВЗ
 *
 * @see https://api.dalli-service.com/v1/doc/pointsInfo
 * @JMS\XmlRoot("pointsInfo")
 */
class PointRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = PointResponse::class;

    /**
     * Может принимать значения: DS, SDEK, BOXBERRY, 5POST
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("partner")
     */
    private ?string $partner = null;

    /**
     * Код ФИАС. Указывается вместо города и области. Рекомендуем использовать именно его, а не текстовое название города
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("fias")
     */
    private ?string $fias = null;

    /**
     * Область
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("settlement")
     */
    private ?string $settlement = null;

    /**
     * Город (не рекомендуется)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("town")
     */
    private ?string $town = null;

    /**
     * Код ПВЗ
     * Параметры поиска ПВЗ не являются обязательными. Если не указан ни один параметр, то вы получите список всех ПВЗ
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("pvzcode")
     */
    private ?string $pvzcode = null;

    /**
     * Индекс
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("zipcode")
     */
    private ?string $zipcode = null;

    /**
     * Если 1 - принимает оплату картой, 0 - не принимает оплату картой, null - сброс фильтра
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("acquiring")
     */
    private ?string $acquiring = null;

    /**
     * Если 1 -принимает оплату наличными, 0 - не принимает оплату наличными, null - сброс фильтра
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("cash")
     */
    private ?string $cash = null;

    /**
     * @param string|null $town
     * @param string|null $partner
     * @param string|null $settlement
     * @param string|null $fias
     * @param string|null $zipcode
     */
    public function __construct(?string $town = null, ?string $partner = null, ?string $settlement = null, ?string $fias = null, ?string $zipcode = null)
    {
        $this->town = $town;
        $this->partner = $partner;
        $this->settlement = $settlement;
        $this->fias = $fias;
        $this->zipcode = $zipcode;
    }

    /**
     * @return string|null
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @param string|null $town
     *
     * @return PointRequest
     */
    public function setTown(?string $town): PointRequest
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPartner(): ?string
    {
        return $this->partner;
    }

    /**
     * @param string|null $partner
     *
     * @return PointRequest
     */
    public function setPartner(?string $partner): PointRequest
    {
        //todo add enums validation
        $this->partner = $partner;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSettlement(): ?string
    {
        return $this->settlement;
    }

    /**
     * @param string|null $settlement
     *
     * @return PointRequest
     */
    public function setSettlement(?string $settlement): PointRequest
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFias(): ?string
    {
        return $this->fias;
    }

    /**
     * @param string|null $fias
     *
     * @return PointRequest
     */
    public function setFias(?string $fias): PointRequest
    {
        $this->fias = $fias;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     *
     * @return PointRequest
     */
    public function setZipcode(?string $zipcode): PointRequest
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPvzcode(): ?string
    {
        return $this->pvzcode;
    }

    /**
     * @param string|null $pvzcode
     *
     * @return PointRequest
     */
    public function setPvzcode(?string $pvzcode): PointRequest
    {
        $this->pvzcode = $pvzcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAcquiring(): ?string
    {
        return $this->acquiring;
    }

    /**
     * @param string|null $acquiring
     *
     * @return $this
     */
    public function setAcquiring(?string $acquiring): PointRequest
    {
        $this->acquiring = $acquiring;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCash(): ?string
    {
        return $this->cash;
    }

    /**
     * @param string|null $cash
     *
     * @return $this
     */
    public function setCash(?string $cash): PointRequest
    {
        $this->cash = $cash;
        return $this;
    }
}
