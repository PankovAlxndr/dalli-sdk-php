<?php

declare(strict_types=1);

namespace DalliSDK\Requests\Act\TransferReturn;

use DalliSDK\Requests\AbstractRequest;
use DalliSDK\Requests\RequestInterface;
use DalliSDK\Responses\Act\TransferReturns\ActTransferReturnResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Запрос файла акта возврата
 *
 * @see https://api.dalli-service.com/v1/doc/returnTransfers
 * @JMS\XmlRoot("returnTransfers")
 */
class ActTransferReturnRequest extends AbstractRequest implements RequestInterface
{
    public const RESPONSE_CLASS = ActTransferReturnResponse::class;

    /**
     * Дата, с которой начать поиск
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("from")
     */
    private ?\DateTimeInterface $from = null;

    /**
     * Дата, по которую вести поиск
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("to")
     */
    private ?\DateTimeInterface $to = null;

    /**
     * JSON|XML меняет формат ответа (по умолчанию "XML")
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("output")
     */
    private string $output = 'XML';

    /**
     * Более подробный формат ответа при значении YES, может принимать значения:
     *  NO - (значение по-умолчанию)
     *  YES
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("detail")
     */
    private string $detail = 'YES';

    /**
     * Номер акта возврата
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("aNumber")
     */
    private ?string $aNumber = null;

    /**
     * @return \DateTimeInterface|null
     */
    public function getFrom(): ?\DateTimeInterface
    {
        return $this->from;
    }

    /**
     * @param \DateTimeInterface|null $from
     *
     * @return ActTransferReturnRequest
     */
    public function setFrom(?\DateTimeInterface $from): ActTransferReturnRequest
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getTo(): ?\DateTimeInterface
    {
        return $this->to;
    }

    /**
     * @param \DateTimeInterface|null $to
     *
     * @return ActTransferReturnRequest
     */
    public function setTo(?\DateTimeInterface $to): ActTransferReturnRequest
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return string|null
     */
    public function getANumber(): ?string
    {
        return $this->aNumber;
    }

    /**
     * @param string|null $aNumber
     *
     * @return ActTransferReturnRequest
     */
    public function setANumber(?string $aNumber): ActTransferReturnRequest
    {
        $this->aNumber = $aNumber;
        return $this;
    }
}
