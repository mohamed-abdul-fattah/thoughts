<?php

namespace App\Entities;

class Notebook extends Entity
{
    private int $id;
    private string $titleAr;
    private string $titleEn;
    private string $createdAt;
    private ?string $updatedAt;
    private int $shelfId;

    public function getArabicTitle(): string
    {
        return $this->titleAr;
    }

    public function getEnglishTitle(): string
    {
        return $this->titleEn;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
