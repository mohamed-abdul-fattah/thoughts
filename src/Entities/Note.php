<?php

namespace App\Entities;

class Note extends Entity
{
    private int $id;
    private int $notebookId;
    private string $title;
    private string $content;
    private string $createdAt;
    private string $updatedAt;

    public function setNotebookId(int $notebookId): Note
    {
        $this->notebookId = $notebookId;
        return $this;
    }

    public function setTitle(string $title): Note
    {
        $this->title = $title;
        return $this;
    }

    public function setContent(string $content): Note
    {
        $this->content = $content;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNotebookId(): int
    {
        return $this->notebookId;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
