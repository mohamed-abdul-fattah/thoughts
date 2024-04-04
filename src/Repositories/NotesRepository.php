<?php

namespace App\Repositories;

use App\Entities\Note;
use Override;

class NotesRepository extends Repository
{
    public function findByNotebookId(mixed $notebookId): array
    {
        return $this->findBy(compact('notebookId'));
    }

    #[Override] protected function getEntityName(): string
    {
        return Note::class;
    }
}
