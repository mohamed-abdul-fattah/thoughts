<?php

namespace App\Controllers;

use App\Entities\Shelf;
use App\Foundation\Http\Response;
use App\Repositories\NotebooksRepository;
use App\Repositories\ShelvesRepository;

class ShelvesController extends Controller
{
    public function showAction(): Response
    {
        /** @var Shelf $shelf */
        $shelf     = (new ShelvesRepository())->find($this->request->get('shelveId'));
        $notebooks = (new NotebooksRepository())->findByShelfId($shelf->getId());

        return $this->render('shelves.show', compact('shelf', 'notebooks'));
    }

    public function createAction(): Response
    {
        $shelfId = $this->request->get('shelfId');

        return $this->render('shelves.create', compact('shelfId'));
    }
}
