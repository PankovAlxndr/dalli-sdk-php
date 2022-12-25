<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Stickers;

use DalliSDK\Enums\ReturnAs;
use DalliSDK\Responses\Stickers\StickersXmlResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Получить ярлыки(наклейки) на заказы при этом ответ в xml
 *
 * @see https://api.dalli-service.com/v1/doc/stickers
 * @JMS\XmlRoot("stickers")
 */
class StickersXmlRequest extends BaseStickersRequest
{
    public const RESPONSE_CLASS = StickersXmlResponse::class;

    /**
     * Тег, который указывает формат передачи данных. Принимает значения base64 и stream.
     * По-умолчанию stream (не обязательный элемент)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("returnas")
     */
    private string $returnAs = ReturnAs::XML;
}
