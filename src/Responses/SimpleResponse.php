<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

/**
 * Класс для ответов типа stream, например для сохранения акта в формате pdf
 */
class SimpleResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private string $httpBody;
    /**
     * @var int
     */
    private int $httpCode;

    /**
     * @param string $httpBody
     * @param int    $httpCode
     */
    public function __construct(string $httpBody, int $httpCode)
    {
        $this->httpBody = $httpBody;
        $this->httpCode = $httpCode;
    }

    /**
     * @return string
     */
    public function getHttpBody(): string
    {
        return $this->httpBody;
    }

    /**
     * @param string $httpBody
     *
     * @return SimpleResponse
     */
    public function setHttpBody(string $httpBody): SimpleResponse
    {
        $this->httpBody = $httpBody;
        return $this;
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @param int $httpCode
     *
     * @return SimpleResponse
     */
    public function setHttpCode(int $httpCode): SimpleResponse
    {
        $this->httpCode = $httpCode;
        return $this;
    }
}
