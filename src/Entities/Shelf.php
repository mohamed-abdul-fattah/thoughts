<?php

namespace App\Entities;

class Shelf
{
  private int $id;
  private string $slug;
  private string $title_ar;
  private string $title_en;
  private string $created_at;
  private ?string $updated_at;

  public function __construct()
  {
    //
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function getArabicTitle(): string
  {
    return $this->title_ar;
  }

  public function getEnglishTitte(): string
  {
    return $this->title_en;
  }

  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  public function setTitleAr(string $title_ar): void
  {
    $this->title_ar = $title_ar;
  }

  public function setTitleEn(string $title_en): void
  {
    $this->title_en = $title_en;
  }
}
