<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Stickers\Basket;

use DalliSDK\Enums\ReturnAs;
use DalliSDK\Requests\Stickers\BaseStickersRequest;
use DalliSDK\Responses\SimpleResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Получить ярлыки(наклейки) на заказы из корзины при этом ответ поток с pdf файлом в виде массива байт
 *
 * @see https://api.dalli-service.com/v1/doc/stickersbasket
 * @JMS\XmlRoot("stickersbasket")
 */
class StickersStreamRequest extends BaseStickersRequest
{
    public const RESPONSE_CLASS = SimpleResponse::class;

    /**
     * Тег, который указывает формат передачи данных. Принимает значения base64 и stream.
     * По-умолчанию stream (не обязательный элемент)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("returnas")
     */
    private string $returnAs = ReturnAs::STREAM;
}
