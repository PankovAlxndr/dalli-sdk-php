<?php

declare(strict_types=1);

namespace DalliSDK\Test\Integration;

use DalliSDK\Requests\RequestInterface;
use JMS\Serializer\Naming\CamelCaseNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class SerializerTestCase extends TestCase
{
    private static Serializer $serializer;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new CamelCaseNamingStrategy()))
            ->build();
    }

    protected function getSerializer(): Serializer
    {
        return $this::$serializer;
    }

    protected function assertSameXml(string $xml, RequestInterface $request)
    {
        $responseXml = $this->getSerializer()->serialize($request, 'xml');
        $this->assertXmlStringEqualsXmlString($xml, $responseXml);
    }
}
