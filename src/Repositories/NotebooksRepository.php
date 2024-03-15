<?php

namespace App\Repositories;

use App\Entities\Notebook;
use Override;

class NotebooksRepository extends Repository
{
    #[Override] protected function getEntityName(): string
    {
        return Notebook::class;
    }

    public function findByShelfId(int $shelfId)
    {
        return $this->findBy(compact('shelfId'));
    }
}
