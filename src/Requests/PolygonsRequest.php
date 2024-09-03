<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\RawDataResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос списка полигонов в формате GeoJSON
 *
 * @see https://api.dalli-service.com/v1/doc/getpolygons
 * @JMS\XmlRoot("getPolygons")
 */
class PolygonsRequest extends AbstractRequest implements RequestInterface, MustRawJson
{
    public const RESPONSE_CLASS = RawDataResponse::class;

    /**
     * Тип доставки
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("service")
     */
    private int $service;

    /**
     * Зона доставки
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("zone")
     */
    private int $zone;

    /**
     * Код филиала
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("filial")
     */
    private int $filial;

    /**
     * @param int $service
     * @param int $zone
     * @param int $filial
     */
    public function __construct(int $service, int $zone, int $filial)
    {
        $this->service = $service;
        $this->zone = $zone;
        $this->filial = $filial;
    }

    /**
     * @return int
     */
    public function getService(): int
    {
        return $this->service;
    }

    /**
     * @return int
     */
    public function getZone(): int
    {
        return $this->zone;
    }

    /**
     * @return int
     */
    public function getFilialCode(): int
    {
        return $this->filial;
    }
}
