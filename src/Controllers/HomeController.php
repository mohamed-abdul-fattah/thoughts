<?php

namespace App\Controllers;

use App\Foundation\Http\Response;
use App\Repositories\ShelvesRepository;

class HomeController extends Controller
{
  public function indexAction(): Response
  {
    $shelves = (new ShelvesRepository())->fetchAll();

    return $this->render('home', compact('shelves'));
  }
}
