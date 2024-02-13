<?php

namespace App\Controllers;

use App\Foundation\Http\Response;

class HomeController extends Controller
{
  public function indexAction(): Response
  {
    return new Response();
  }
}
