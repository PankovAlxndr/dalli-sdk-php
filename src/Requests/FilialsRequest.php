<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\FilialsResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос списка филиалов компании Dalli
 *
 * @see https://api.dalli-service.com/v1/doc/filials
 * @JMS\XmlRoot("filials")
 */
class FilialsRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = FilialsResponse::class;
}
