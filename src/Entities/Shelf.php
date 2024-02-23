<?php

namespace App\Entities;

class Shelf
{
  private int $id;
  private string $title;
  private string $created_at;
  private ?string $updated_at;

  public function __construct()
  {
    //
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getTitle(): string
  {
    return $this->title;
  }
}
