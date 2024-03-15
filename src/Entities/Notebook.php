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

    public function getTitleAr(): string
    {
        return $this->titleAr;
    }

    public function getTitleEn(): string
    {
        return $this->titleEn;
    }
}
