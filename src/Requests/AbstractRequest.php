<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

use DalliSDK\Models\Auth;

abstract class AbstractRequest
{
    /**
     * @var Auth|null
     */
    private ?Auth $auth = null;

    /**
     * @param string $token
     *
     * @return void
     */
    public function setAuth(string $token): void
    {
        $this->auth = new Auth($token);
    }

    /**
     * @return Auth|null
     */
    public function getAuth(): ?Auth
    {
        return $this->auth;
    }

    /**
     * @return string
     * @psalm-suppress UndefinedConstant
     */
    public function getResponseClass(): string
    {
        return static::RESPONSE_CLASS;
    }
}
