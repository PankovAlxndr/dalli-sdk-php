<?php

declare(strict_types=1);

namespace DalliSDK\Responses;

/**
 * Вспомогательный класс, который оборачивает любые данные и реализует стандартный для библиотеки интерфейс ResponseInterface
 * используется в запросе списка полигонов в формате GeoJSON
 */
class RawDataResponse implements ResponseInterface
{
    private $rawData = null;

    public function __construct($response = null)
    {
        $this->rawData = $response;
    }

    /**
     * @return mixed|null
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @param mixed|null $rawData
     *
     * @return RawDataResponse
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;
        return $this;
    }
}
