<?php

use App\Foo;

require_once __DIR__.'/../vendor/autoload.php';

if (isset($_REQUEST['getBar'])) {
    $result = Foo::getBar();
    print_r($result);
} elseif (isset($_REQUEST['cacheWarmup'])) {
    Foo::getBar();
} else {
    $index = file_get_contents(__DIR__.'/index.html');
    echo $index;

    // Delete cache;
    $cacheFile = ROOT_DIR.'/cache.dat';
    if (file_exists($cacheFile)) {
        unlink($cacheFile);
    }
}
