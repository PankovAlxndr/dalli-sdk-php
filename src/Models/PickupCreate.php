<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use DalliSDK\Traits\Fillable;
use JMS\Serializer\Annotation as JMS;

/**
 * Модель для оформление заявки на забор
 *
 * @see https://api.dalli-service.com/doc/v1/pickupcreate
 * @JMS\XmlRoot("pickup")
 */
class PickupCreate
{
    use Fillable;

    /**
     * Атрибут с кодом точки забора. Должен быть уникальным в рамках одного клиента
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("code")
     */
    private int $code;

    /**
     * Дата забора в формате yyyy-mm-dd (обязательный тег)
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\SerializedName("date")
     */
    private \DateTimeInterface $date;

    /**
     * Если требуется возврат товара, то укажите значение "YES".
     * Иначе можно не заполнять
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("return")
     */
    private string $return = 'NO';

    /**
     * Примечание
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("instruction")
     */
    private ?string $instruction = null;



    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return PickupCreate
     */
    public function setCode(int $code): PickupCreate
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return PickupCreate
     */
    public function setDate(\DateTimeInterface $date): PickupCreate
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturn(): string
    {
        return $this->return;
    }

    /**
     * @return PickupCreate
     */
    public function setReturn(string $return): PickupCreate
    {
        if (!in_array($return, ['YES', 'NO'], true)) {
            throw new \InvalidArgumentException(
                sprintf('Return must be one of: %s', implode(', ', ['YES', 'NO']))
            );
        }

        $this->return = $return;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    /**
     * @return PickupCreate
     */
    public function setInstruction(?string $instruction): PickupCreate
    {
        $this->instruction = $instruction;
        return $this;
    }
}
