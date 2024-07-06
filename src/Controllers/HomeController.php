<?php

namespace App\Controllers;

use App\Foundation\Http\Cookie;
use App\Foundation\Http\Response;
use App\Repositories\ShelvesRepository;

class HomeController extends Controller
{
  public function indexAction(): Response
  {
    $shelves = (new ShelvesRepository())->fetchAll();

    return $this->render('home', compact('shelves'));
  }

  public function switchLocaleAction()
  {
      $toLocale = $this->request->get('toLocale', app()->getLocale());
      $this->request->cookies->set(new Cookie('locale', $toLocale, strToTime('+360 days')));

      $this->redirectToUrl('/');
  }
}
