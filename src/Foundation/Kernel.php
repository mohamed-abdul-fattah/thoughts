<?php

namespace App\Foundation;

class Kernel
{
  public function boot(): Application
  {
    return new Application();
  }
}
