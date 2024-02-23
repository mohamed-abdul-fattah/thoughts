<?php

namespace App\Repositories;

use App\Entities\Shelf;
use Override;

class ShelvesRepository extends Repository
{
  #[Override] protected function getEntityName(): string
  {
    return Shelf::class;
  }
}
