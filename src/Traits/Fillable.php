<?php

declare(strict_types=1);

namespace DalliSDK\Traits;

trait Fillable
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (!\property_exists($this, $key)) {
                throw new \InvalidArgumentException(\sprintf('The class "%s" does not have the property "%s"', static::class, $key));
            }
            $this->{$key} = $value;
        }
    }


    public static function create($data = [])
    {
        \assert(\is_array($data));
        return new static($data);
    }
}
