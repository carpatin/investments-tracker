<?php

declare(strict_types=1);

namespace App\GraphQL;

use Str;

trait FieldNameCaseMapper
{
    protected function toSnakeCaseKeys(array $array): array
    {
        return $this->changeArrayKeys($array, fn ($key) => Str::snake($key));
    }

    private function changeArrayKeys(array &$array, callable $callback): array
    {
        $array = array_reduce(array_keys($array), function ($carry, $key) use ($array, $callback) {
            $newKey = $callback($key);
            $carry[$newKey] = is_array($array[$key]) ? $this->changeArrayKeys($array[$key], $callback) : $array[$key];

            return $carry;
        }, []);

        return $array;
    }
}
