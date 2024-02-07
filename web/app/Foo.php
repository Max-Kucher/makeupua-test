<?php

namespace App;

class Foo implements IBarGetter
{
    /**
     * @return array|null
     * @throws \Exception
     */
    private static function ensureCachedData(): array|null
    {
        $result = Cache::get('bar');
        if ($result !== null) {
            fnPrintR('We got the data from the cache');

            return $result;
        }

        $lockFile = Cache::acquireLock();
        if ($lockFile === false) {
            usleep(100000);
            $result = Cache::get('bar');
            if ($result === null) {
                throw new \Exception('Something went wrong with caching');
            } else {
                fnPrintR('We received data from the cache but after a locking attempt');
            }
        } else {
            try {
                $result = Cache::get('bar');
                if ($result === null) {
                    $result = BlackBox::getBar();
                    Cache::put('bar', $result);

                    fnPrintR('Data was cached');
                }
            } finally {
                Cache::releaseLock($lockFile);
            }
        }

        return $result;
    }

    public static function getBar(): array
    {
        try {
            $bar = self::ensureCachedData();
        } catch (\Throwable $e) {
            // Some error handling
            echo $e->getMessage();
            die;
        }

        return is_null($bar) ? [] : $bar;
    }
}