<?php

declare(strict_types=1);

namespace DalliSDK\Enums;

/**
 * На стороне курьерской службы имеются веб-сервисы по 2ev адресам, выбирать нужно тот филиал, с которым вы работаете
 *
 * @see https://api.dalli-service.com/v1/doc/shared-info
 */
class Endpoint
{
    public const MSK = 'https://api.dalli-service.com/v1/';
    public const SPB = 'https://spbapi.dalli-service.com/v1/';
}
