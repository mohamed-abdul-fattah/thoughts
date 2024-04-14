<?php

namespace App\Entities;

class Shelf extends Entity
{
    private ?int $id = null;
    private string $slug;
    private string $titleAr;
    private string $titleEn;
    private string $createdAt;
    private ?string $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArabicTitle(): string
    {
        return $this->titleAr;
    }

    public function getEnglishTitte(): string
    {
        return $this->titleEn;
    }

    public function setArabicTitle(string $titleAr): Shelf
    {
        $this->titleAr = $titleAr;
        return $this;
    }

    public function setEnglishTitle(string $titleEn): Shelf
    {
        $this->titleEn = $titleEn;
        return $this;
    }
}
