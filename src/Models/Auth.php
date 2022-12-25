<?php

declare(strict_types=1);

namespace DalliSDK\Models;

use JMS\Serializer\Annotation as JMS;

/** @JMS\XmlRoot("auth") */
class Auth
{
    /** @JMS\XmlAttribute */
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
