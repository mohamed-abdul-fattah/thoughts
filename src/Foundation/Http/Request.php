<?php

namespace App\Foundation\Http;

class Request
{
  private string $uri;

  public function __construct()
  {
    $this->uri = $_SERVER['REQUEST_URI'];
  }

  public function getUri(): string
  {
    return $this->uri;
  }
}
