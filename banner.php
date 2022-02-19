<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Helper\Env;
use App\Models\Viewer;

require 'vendor/autoload.php';

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('Content-Type: image/gif');
    readfile('src/assets/img/2825711.gif');
    return;
}

(new Env(__DIR__.'/.env'))->load();

$viewer = new Viewer;
$viewer->start();

header('Content-Type: image/gif');
readfile('src/assets/img/2825711.gif');