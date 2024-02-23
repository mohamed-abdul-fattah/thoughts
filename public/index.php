<?php

use App\Foundation\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = Application::getInstance();
$app->run();
