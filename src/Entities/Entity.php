<?php

namespace App\Entities;

abstract class Entity
{
  public function isPersisted(): bool
  {
      return $this->getId() !== null;
  }

  abstract public function getId(): mixed;
}
