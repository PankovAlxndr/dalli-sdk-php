<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\OrderDeliveryStatusCommitResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос после успешной обработки ответа необходимо
 * отметить полученные статусы успешно полученными, отправив данный запрос
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("commitlaststatus")
 */
class OrderDeliveryStatusCommitRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = OrderDeliveryStatusCommitResponse::class;
}
