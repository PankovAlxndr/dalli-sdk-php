<?php

declare(strict_types=1);

namespace DalliSDK\Responses\Act\TransferMoney;

use DalliSDK\Models\StickerOrder;
use DalliSDK\Models\TransferMoneyAct;
use DalliSDK\Responses\ResponseInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Сюда мапится ответ на запрос получение актов передачи денег
 *
 * @see https://api.dalli-service.com/v1/doc/moneyTransfers
 *
 * @JMS\XmlRoot("moneyTransfers")
 *
 * @template-implements \IteratorAggregate<int, TransferMoneyAct>
 */
class ActTransferMoneyResponse implements ResponseInterface, \IteratorAggregate
{
    /**
     * @JMS\Type("array<DalliSDK\Models\TransferMoneyAct>")
     * @JMS\XmlList(inline = true, entry = "act")
     * @var TransferMoneyAct[]
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
     * @return \Traversable|TransferMoneyAct[]
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getActs());
    }

    /**
     * @return TransferMoneyAct[]
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
