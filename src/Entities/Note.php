<?php

namespace App\Entities;

class Note extends Entity
{
    private int $id;
    private int $notebookId;
    private string $title;
    private string $createdAt;
    private string $updatedAt;
}
