<?php

use App\Foundation\Application;

/**
 * Dumps the given variables.
 *
 * @param  mixed ...$vars
 * @return void
 */
function dump(...$vars): void
{
  echo "<pre>";
  var_dump($vars);
  echo "</pre>";
}

function stylesheetUrl(string $filename): string
{
  return "/assets/css/{$filename}.css";
}

function app(): Application
{
  return Application::getInstance();
}
