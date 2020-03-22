<?php

namespace Neko\Menu\Helpers;

class Arr
{
    public static function map(array $array, $callback): array
    {
        $keys = array_keys($array);

        $items = array_map($callback, $array, $keys);

        return array_combine($keys, $items);
    }

    public static function push(array $array, $item): array
    {
        array_push($array, $item);

        return $array;
    }

    public static function mapToAssoc(array $items, callable $callback)
    {
        return array_reduce($items, function (array $assoc, $item) use ($callback) {
            [$key, $value] = $callback($item);
            $assoc[$key] = $value;

            return $assoc;
        }, []);
    }
}
