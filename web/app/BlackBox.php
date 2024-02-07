<?php

namespace App;

class BlackBox {
    public static function getBar(): array
    {
        sleep(1);
        return ['data' => 'Some data from BlackBox'];
    }
}