<?php

namespace App\Foundation\Http;

class Request
{
  private string $pathInfo;

  public function __construct()
  {
    $this->pathInfo = $_SERVER['PATH_INFO'];
  }

  public function getPath(): string
  {
    return $this->pathInfo;
  }
}
