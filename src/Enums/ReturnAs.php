<?php

declare(strict_types=1);

namespace DalliSDK\Enums;

/**
 * Формат передачи данных стикеров и актов
 *
 * @see https://api.dalli-service.com/v1/doc/stickersbasket
 * @see https://api.dalli-service.com/v1/doc/getact
 */
class ReturnAs
{
    public const BASE64 = 'base64';
    public const STREAM = 'stream';
    public const XML = 'xml';
}
