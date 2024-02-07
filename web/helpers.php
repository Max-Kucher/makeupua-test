<?php

use JetBrains\PhpStorm\NoReturn;

function fnPrintR(): void
{
    echo '<pre style="padding:10px 20px;border:1px solid#ddd;background-color:#efefef">'.print_r(func_get_args(), true).'</pre>';
}

#[NoReturn]
function fnPrintDie(): void
{
    fnPrintR(...func_get_args());
    exit;
}
