<?php

/**
 * Dumps the given variables.
 *
 * @param mixed ...$vars
 * @return void
 */
function dump(...$vars): void
{
  echo "<pre>";
  var_dump($vars);
  echo "</pre>";
}
