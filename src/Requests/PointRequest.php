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
    private ?string $partner = null;
    private ?string $fias = null;
    private ?string $settlement = null;
    private ?string $town = null;
    private ?string $zipcode = null;

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
}
