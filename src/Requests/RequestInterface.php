<?php

declare(strict_types=1);

namespace DalliSDK\Requests;

interface RequestInterface
{
    public function getResponseClass(): string;

    public function setAuth(string $token): void;
}
