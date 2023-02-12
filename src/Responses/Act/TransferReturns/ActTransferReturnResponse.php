<?php

declare(strict_types=1);

namespace DalliSDK\Responses\Act\TransferReturns;

use DalliSDK\Models\TransferReturnAct;
use DalliSDK\Responses\ResponseInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос получение актов возврата
 *
 * @see https://api.dalli-service.com/v1/doc/returnTransfers
 *
 * @JMS\XmlRoot("returnTransfers")
 *
 * @template-implements \IteratorAggregate<int, TransferReturnAct>
 */
class ActTransferReturnResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\TransferReturnAct>")
     * @JMS\XmlList(inline = true, entry = "act")
     * @var TransferReturnAct[]
     */
    private array $items = [];

    /**
     * Код ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("int")
     */
    private ?int $error = null;

    /**
     * Текст ошибки
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("errormsg")
     */
    private ?string $errorMsg = null;

    /**
     * @return \Traversable|TransferReturnAct[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getActs());
    }

    /**
     * @return TransferReturnAct[]
     */
    public function getActs(): array
    {
        return $this->items;
    }

    /**
     * @return int|null
     */
    public function getError(): ?int
    {
        return $this->error;
    }

    /**
     * @return string|null
     */
    public function getErrorMsg(): ?string
    {
        return $this->errorMsg;
    }
}
