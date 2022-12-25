<?php

declare(strict_types=1);

namespace DalliSDK\Test\Fixtures;

class FixturesLoader
{
    public static function load($relativePath): string
    {
        return \file_get_contents(__DIR__ . '/' . $relativePath);
    }
}
