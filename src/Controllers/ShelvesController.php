<?php

namespace App\Controllers;

use App\Foundation\Http\Response;
use App\Repositories\ShelvesRepository;

class ShelvesController extends Controller
{
    public function showAction(): Response
    {
        $shelf = (new ShelvesRepository())->find($this->request->get('shelveId'));
        return $this->render('shelves.show', compact('shelf'));
    }
}
