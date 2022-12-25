<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\ServicesResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос типов доставки
 *
 * @see https://api.dalli-service.com/v1/doc/request-types-of-delivery
 * @JMS\XmlRoot("services")
 */
class ServicesRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = ServicesResponse::class;
}
