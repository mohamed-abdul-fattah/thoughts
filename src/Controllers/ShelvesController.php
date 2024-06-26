<?php

namespace App\Controllers;

use App\Entities\Notebook;
use App\Entities\Shelf;
use App\Foundation\Http\Exceptions\HttpMethodNotAllowedException;
use App\Foundation\Http\Response;
use App\Repositories\NotebooksRepository;
use App\Repositories\ShelvesRepository;

class ShelvesController extends Controller
{
    public function showAction(): Response
    {
        /** @var Shelf $shelf */
        $shelf     = (new ShelvesRepository())->find($this->request->get('shelfId'));
        $notebooks = (new NotebooksRepository())->findByShelfId($shelf->getId());

        return $this->render('shelves.show', compact('shelf', 'notebooks'));
    }

    public function createAction(): Response
    {
        $shelfId = $this->request->get('shelfId');

        return $this->render('shelves.create', compact('shelfId'));
    }

    public function storeAction(): Response
    {
        if (!$this->request->isPost()) {
            throw new HttpMethodNotAllowedException("{$this->request->getMethod()} is not allowed for this route!");
        }

        $notebook = new Notebook();
        $notebook
            ->setShelfId($this->request->post('shelfId'))
            ->setTitleAr($this->request->post('titleAr'))
            ->setTitleEn($this->request->post('titleEn'));

        (new NotebooksRepository())->save($notebook);
        $this->redirectToUrl("/shelves?shelfId={$this->request->post('shelfId')}");
    }

    public function editAction(): Response
    {
        $shelf = (new ShelvesRepository())->find($this->request->get('shelfId'));

        return $this->render('shelves.edit', compact('shelf'));
    }

    public function updateAction(): Response
    {
        if (!$this->request->isPost()) {
            throw new HttpMethodNotAllowedException("{$this->request->getMethod()} is not allowed for this route!");
        }

        /** @var Shelf $shelf */
        $repository = new ShelvesRepository();
        $shelf      = $repository->find($this->request->post('shelfId'));

        $shelf->setArabicTitle($this->request->post('titleAr'))
              ->setEnglishTitle($this->request->post('titleEn'));

        $repository->save($shelf);
        $this->redirectToUrl("/");
    }
}
