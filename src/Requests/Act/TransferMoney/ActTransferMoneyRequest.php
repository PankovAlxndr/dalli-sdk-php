<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Act\TransferMoney;

use DalliSDK\Requests\AbstractRequest;
use DalliSDK\Requests\RequestInterface;
use DalliSDK\Responses\Act\TransferMoney\ActTransferMoneyResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос файла акта передачи денег
 *
 * @see https://api.dalli-service.com/v1/doc/moneyTransfers
 * @JMS\XmlRoot("moneyTransfers")
 */
class ActTransferMoneyRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = ActTransferMoneyResponse::class;

    /**
     * Дата, с которой начать поиск (обязательный элемент)
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("from")
     */
    private \DateTimeInterface $from;

    /**
     * Дата, по которую вести поиск (по умолчанию "сегодня")
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("to")
     */
    private \DateTimeInterface $to;

    /**
     *  JSON|XML меняет формат ответа (по умолчанию "XML")
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("output")
     */
    private string $output = 'XML';


    /**
     * @param \DateTimeInterface $from
     * @param \DateTimeInterface $to
     */
    public function __construct(\DateTimeInterface $from, \DateTimeInterface $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getFrom(): \DateTimeInterface
    {
        return $this->from;
    }

    /**
     * @param \DateTimeInterface $from
     *
     * @return ActTransferMoneyRequest
     */
    public function setFrom(\DateTimeInterface $from): ActTransferMoneyRequest
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTo(): \DateTimeInterface
    {
        return $this->to;
    }

    /**
     * @param \DateTimeInterface $to
     *
     * @return ActTransferMoneyRequest
     */
    public function setTo(\DateTimeInterface $to): ActTransferMoneyRequest
    {
        $this->to = $to;
        return $this;
    }
}
