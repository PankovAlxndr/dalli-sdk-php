<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use JMS\Serializer\Annotation as JMS;

/**
 * Ответ на коммит запроса получение только обновленных заказов
 *
 * @see https://api.dalli-service.com/v1/doc/cost-delivery
 * @JMS\XmlRoot("commitlaststatus")
 */
class OrderDeliveryStatusCommitResponse implements ResponseInterface
{
    /**
     * @JMS\XmlValue()
     * @JMS\Type("string")
     */
    private ?string $status = null;

    /**
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $error = null;

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getError(): ?int
    {
        return $this->error;
    }
}
