<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Stickers;

use DalliSDK\Requests\AbstractRequest;
use DalliSDK\Requests\RequestInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Получить ярлыки(наклейки) на заказы
 *
 * @see https://api.dalli-service.com/v1/doc/stickers
 */
class BaseStickersRequest extends AbstractRequest implements RequestInterface
{
    /**
     * Тег, который указывает формат бумаги.
     * Принимает значения 1 - Зебра, 2 - А4 с рамкой, 3 - А4 без рамки, 4 - A6.
     * По умолчанию 1 (необязательный элемент)
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("format")
     */
    private ?int $format = 1;

    /**
     * Контейнер, который содержит штрих-коды заказов.
     * По-умолчанию все переданные заказы за сегодня (не обязательный элемент)
     *
     * @JMS\XmlList(inline = false, entry = "barcode")
     */
    private ?array $barcodes = null;


    /**
     * @param int        $format
     * @param array|null $barcodes
     */
    public function __construct(int $format = 1, ?array $barcodes = null)
    {
        $this->format = $format;
        $this->barcodes = $barcodes;
    }

    /**
     * @return int|null
     */
    public function getFormat(): ?int
    {
        return $this->format;
    }

    /**
     * @param int $format
     *
     * @return $this
     */
    public function setFormat(int $format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getBarcodes(): ?array
    {
        return $this->barcodes;
    }

    /**
     * @param array|null $barcodes
     *
     * @return $this
     */
    public function setBarcodes(?array $barcodes)
    {
        $this->barcodes = $barcodes;
        return $this;
    }
}
