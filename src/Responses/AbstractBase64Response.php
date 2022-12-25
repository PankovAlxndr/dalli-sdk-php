<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

use JMS\Serializer\Annotation as JMS;

abstract class AbstractBase64Response implements ResponseInterface
{
    /**
     * обычно PDF закодированный в base64
     *
     * @JMS\Type("string")
     */
    private string $base64;

    /**
     * @return string
     */
    public function getBase64(): string
    {
        return $this->base64;
    }
}
