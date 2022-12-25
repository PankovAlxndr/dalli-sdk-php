<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Responses\OrderDeliveryStatusResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос статусов доставки
 *
 * @see https://api.dalli-service.com/v1/doc/request-delivery-status
 * @JMS\XmlRoot("statusreq")
 */
class OrderDeliveryStatusRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = OrderDeliveryStatusResponse::class;

    /**
     * Номер заказа
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("orderno")
     */
    private string $orderNo;

    /**
     * Дата "с"
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("datefrom")
     */
    private \DateTimeInterface $dateFrom;

    /**
     * Дата "по"
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("dateto")
     */
    private \DateTimeInterface $dateTo;

    /**
     * Может принимать значение только ONLY_LAST. Если указан этот параметр, все остальные игнорируются.
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("changes")
     */
    private ?string $changes = null;

    /**
     * По умолчанию идёт поиск по дате оформления, но если указать в этом параметре YES, то поиск будет идти по дате доставки
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("datedelivery")
     */
    private ?string $dateDelivery = null;

    /**
     * @return string
     */
    public function getOrderNo(): string
    {
        return $this->orderNo;
    }

    /**
     * @param string $orderNo
     *
     * @return OrderDeliveryStatusRequest
     */
    public function setOrderNo(string $orderNo): OrderDeliveryStatusRequest
    {
        $this->orderNo = $orderNo;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateFrom(): \DateTimeInterface
    {
        return $this->dateFrom;
    }

    /**
     * @param \DateTimeInterface $dateFrom
     *
     * @return OrderDeliveryStatusRequest
     */
    public function setDateFrom(\DateTimeInterface $dateFrom): OrderDeliveryStatusRequest
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateTo(): \DateTimeInterface
    {
        return $this->dateTo;
    }

    /**
     * @param \DateTimeInterface $dateTo
     *
     * @return OrderDeliveryStatusRequest
     */
    public function setDateTo(\DateTimeInterface $dateTo): OrderDeliveryStatusRequest
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChanges(): ?string
    {
        return $this->changes;
    }

    /**
     * @param string|null $changes
     *
     * @return OrderDeliveryStatusRequest
     */
    public function setChanges(?string $changes): OrderDeliveryStatusRequest
    {
        $this->changes = $changes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateDelivery(): ?string
    {
        return $this->dateDelivery;
    }

    /**
     * @param string|null $dateDelivery
     *
     * @return OrderDeliveryStatusRequest
     */
    public function setDateDelivery(?string $dateDelivery): OrderDeliveryStatusRequest
    {
        $this->dateDelivery = $dateDelivery;
        return $this;
    }
}
