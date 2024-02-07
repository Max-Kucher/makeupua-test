<?php

namespace App;

/**
 * Super simple Cache class stub
 */
class Cache
{
    protected static string $filePath = ROOT_DIR.'/cache.dat';

    public static function put(string $key, mixed $value, int $duration = 3600): void
    {
        $data = self::getAllCachedData();
        $data[$key] = [
            'expires' => time() + $duration,
            'value' => $value
        ];
        file_put_contents(self::$filePath, serialize($data));
    }

    public static function get($key): mixed
    {
        $data = self::getAllCachedData();
        if (isset($data[$key]) && $data[$key]['expires'] > time()) {
            return $data[$key]['value'];
        }
        return null;
    }

    protected static function getAllCachedData(): array
    {
        if (file_exists(self::$filePath)) {
            return unserialize(file_get_contents(self::$filePath));
        }

        return [];
    }
}

