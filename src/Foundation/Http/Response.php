<?php

namespace App\Foundation\Http;

class Response
{
  public function __toString(): string
  {
    return "Hello, world";
  }
}
