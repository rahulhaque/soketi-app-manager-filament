<?php

foreach (glob(__DIR__.'/*Helper.php') as $file) {
    require_once $file;
}
