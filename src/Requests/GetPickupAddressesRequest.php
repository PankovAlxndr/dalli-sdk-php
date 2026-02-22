<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Models\Code;
use DalliSDK\Responses\GetPickupAddressesResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Получение адресов забора
 *
 * @see https://api.dalli-service.com/doc/v1/getPickupAddresses
 * @JMS\XmlRoot("getPickupAddresses")
 */
class GetPickupAddressesRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = GetPickupAddressesResponse::class;

    /**
     * Контейнер кодов
     *
     * @JMS\XmlList(inline = false, entry = "code")
     * @JMS\SerializedName("codes")
     *
     */
    private ?array $codes = null;

    /**
     * @return array|null
     */
    public function getCodes(): ?array
    {
        return $this->codes;
    }

    /**
     * @param array|null $packages
     *
     * @return GetPickupAddressesRequest
     */
    public function setCodes(?array $codes): GetPickupAddressesRequest
    {
        $this->codes = $codes;
        return $this;
    }

    /**
     * @param int $code
     *
     * @return GetPickupAddressesRequest
     */
    public function addCode(int $code): GetPickupAddressesRequest
    {
        if ($this->codes === null) {
            $this->codes = [];
        }

        $this->codes[] = $code;

        return $this;
    }
}
