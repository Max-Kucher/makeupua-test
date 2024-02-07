<?php

namespace App;

class BlackBox implements IBarGetter
{
    public static function getBar(): array
    {
        sleep(1);
        return ['data' => 'Some data from BlackBox'];
    }
}