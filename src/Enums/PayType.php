<?php

declare(strict_types=1);

namespace DalliSDK\Enums;

/**
 * Тип оплаты получателем
 *
 * @see https://api.dalli-service.com/v1/doc/createbasket
 */
class PayType
{
    public const CASH = 'CASH';
    public const CARD = 'CARD';
    public const NO = 'NO';
}
