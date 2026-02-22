<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Models\PickupCreate;
use DalliSDK\Responses\PickupCreateResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Оформление заявки на забор
 *
 * @see https://api.dalli-service.com/doc/v1/pickupcreate
 * @JMS\XmlRoot("pickupcreate")
 */
class PickupCreateRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = PickupCreateResponse::class;

    /**
     * @JMS\Type("array<DalliSDK\Models\PickupCreate>")
     * @JMS\XmlList(inline = true, entry = "pickup")
     * @var PickupCreate[]
     */
    private ?array $pickups = null;


    /**
     * @return array|null
     */
    public function getPickups(): ?array
    {
        return $this->pickups;
    }

    /**
     * @param array|null $barcodes
     *
     * @return PickupCreateRequest
     */
    public function setPickups(?array $pickups): PickupCreateRequest
    {
        $this->pickups = $pickups;
        return $this;
    }

    /**
     * @param PickupCreate $pickup
     *
     * @return $this
     */
    public function addPickup(PickupCreate $pickup): PickupCreateRequest
    {
        if ($this->pickups === null) {
            $this->pickups = [];
        }
        $this->pickups[] = $pickup;
        return $this;
    }
}
