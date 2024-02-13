<?php

use App\Foundation\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();
$app    = $kernel->boot();

$app->run();
