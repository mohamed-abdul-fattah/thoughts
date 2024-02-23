<?php

use App\Foundation\DotEnv;

return [
  'host'     => DotEnv::get('DB_HOST', 'localhost'),
  'driver'   => DotEnv::get('DB_DRIVER', 'mysql'),
  'name'     => DotEnv::get('DB_NAME'),
  'username' => DotEnv::get('DB_USER'),
  'password' => DotEnv::get('DB_PASS'),
];
