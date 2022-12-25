<?php

declare(strict_types=1);

namespace DalliSDK\Enums;

/**
 * Тип услуги Почты России
 *
 * @see https://api.dalli-service.com/v1/doc/rupost
 */
class RuPost
{
    public const ONLINE = 1;
    public const COURIER = 2;
    public const NOT_STANDARD = 3;
    public const FIRST_CLASS = 4;
}
