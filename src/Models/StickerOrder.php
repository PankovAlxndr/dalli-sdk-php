<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для ярлыков на заказы
 *
 * @see https://api.dalli-service.com/v1/doc/stickers
 * @JMS\XmlRoot("order")
 */
class StickerOrder
{
    use Fillable;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("barcode")
     */
    private ?string $barcode;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("image")
     */
    private ?string $image;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("sender")
     */
    private ?string $sender;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("id_im")
     */
    private ?string $idIm;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("date")
     */
    private ?string $date;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("person")
     */
    private ?string $person;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("address")
     */
    private ?string $address;

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getSender(): ?string
    {
        return $this->sender;
    }

    /**
     * @return string|null
     */
    public function getIdIm(): ?string
    {
        return $this->idIm;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getPerson(): ?string
    {
        return $this->person;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }
}
