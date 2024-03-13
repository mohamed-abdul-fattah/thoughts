<?php

namespace App\Controllers;

use App\Foundation\Http\Response;

class ShelvesController extends Controller
{
    public function showAction(): Response
    {
        return $this->render('shelves.show');
    }
}
