<?php

declare(strict_types=1);

namespace DalliSDK\Enums;

/**
 * Формат бумаги для печати стикеров
 *
 * @see https://api.dalli-service.com/v1/doc/stickers
 */
class Format
{
    public const ZEBRA = 1;
    public const A4_BORDER = 2;
    public const A4 = 3;
    public const A6 = 4;
}
