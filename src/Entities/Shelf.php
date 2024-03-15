<?php

namespace App\Entities;

class Shelf
{
    private int $id;
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
}
