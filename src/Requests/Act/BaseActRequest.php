<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Act;

use DalliSDK\Requests\AbstractRequest;
use DalliSDK\Requests\RequestInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос файла акта приема-передачи
 *
 * @see https://api.dalli-service.com/v1/doc/getact
 */
class BaseActRequest extends AbstractRequest implements RequestInterface
{
    /**
     * Контейнер, который содержит штрих-коды заказов.
     * По-умолчанию все переданные заказы за сегодня (не обязательный элемент)
     *
     * @JMS\XmlList(inline = false, entry = "barcode")
     */
    private ?array $barcodes = null;

    /**
     * @param array|null $barcodes
     */
    public function __construct(?array $barcodes = null)
    {
        $this->barcodes = $barcodes;
    }

    /**
     * @return array|null
     */
    public function getBarcodes(): ?array
    {
        return $this->barcodes;
    }

    /**
     * Штрих-коды. Если указан хотя бы один - в файле акта будут только эти заказы
     *
     * @param array|null $barcodes
     *
     * @return BaseActRequest
     */
    public function setBarcodes(?array $barcodes): BaseActRequest
    {
        $this->barcodes = $barcodes;
        return $this;
    }
}
