<?php

namespace App;

class Foo implements IBarGetter
{
    // TODO: оптимізувати загальний час роботи при 100 rps
    public static function getBar(): array
    {
        $result = Cache::get('bar');
        if ($result !== null) {
            return $result;
        }

        $result = BlackBox::getBar();
        Cache::put('bar', $result);

        return $result;
    }
}