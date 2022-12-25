<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Act;

use DalliSDK\Enums\ReturnAs;
use DalliSDK\Responses\Act\ActBase64Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос файла акта приема-передачи при этом ответ xml c BASE64 внутри
 *
 * @see https://api.dalli-service.com/v1/doc/getact
 * @JMS\XmlRoot("getact")
 */
class ActBase64Request extends BaseActRequest
{
    public const RESPONSE_CLASS = ActBase64Response::class;

    /**
     * Тег, который указывает формат передачи данных. Принимает значения base64 и stream.
     * По-умолчанию stream (не обязательный элемент)
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("returnas")
     */
    private string $returnAs = ReturnAs::BASE64;
}
