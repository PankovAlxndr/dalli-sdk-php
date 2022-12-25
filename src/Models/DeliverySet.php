<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Настройка дифференциальной стоимости доставки
 * Внимание! При явном указании дифференциальной стоимости доставки игнорируется тег priced, а так же настройки Личного Кабинета.
 * Если у вас одинаковые условия по стоимости доставки для всех заявок, тогда вы можете задать их глобально в Личном Кабинете
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 * @see \DalliSDK\Models\Below
 * @JMS\XmlRoot("deliveryset")
 */
class DeliverySet
{
    use Fillable;

    /**
     * Стоимость в случае полного выкупа
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("above_price")
     */
    private float $abovePrice;

    /**
     * Стоимость в случае возврата
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("float")
     * @JMS\SerializedName("return_price")
     */
    private float $returnPrice;

    /**
     * Ставка НДС для позиции Доставка
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     * @JMS\SerializedName("VATrate")
     */
    private ?int $vatRate = null;

    /**
     * Граница стоимости настроек
     *
     * @JMS\Type("array<DalliSDK\Models\Below>")
     * @JMS\XmlList(inline = true, entry = "below")
     * @var \DalliSDK\Models\Below[]
     */
    private array $belows = [];

    /**
     * @return float
     */
    public function getAbovePrice(): float
    {
        return $this->abovePrice;
    }

    /**
     * @return float
     */
    public function getReturnPrice(): float
    {
        return $this->returnPrice;
    }

    /**
     * @return int|null
     */
    public function getVatRate(): ?int
    {
        return $this->vatRate;
    }

    /**
     * @return array
     */
    public function getBelows(): array
    {
        return $this->belows;
    }

    /**
     * @param float $abovePrice
     *
     * @return DeliverySet
     */
    public function setAbovePrice(float $abovePrice): DeliverySet
    {
        $this->abovePrice = $abovePrice;
        return $this;
    }

    /**
     * @param float $returnPrice
     *
     * @return DeliverySet
     */
    public function setReturnPrice(float $returnPrice): DeliverySet
    {
        $this->returnPrice = $returnPrice;
        return $this;
    }

    /**
     * @param int|null $vatRate
     *
     * @return DeliverySet
     */
    public function setVatRate(?int $vatRate): DeliverySet
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    /**
     * @param array $belows
     *
     * @return DeliverySet
     */
    public function setBelows(array $belows): DeliverySet
    {
        $this->belows = $belows;
        return $this;
    }
}
