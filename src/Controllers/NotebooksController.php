<?php

namespace App\Controllers;

use App\Foundation\Http\Exceptions\HttpInternalServerErrorException;
use App\Foundation\Http\Response;
use App\Repositories\NotebooksRepository;

class NotebooksController extends Controller
{
    public function showAction(): Response
    {
        if (!$this->request->has('notebookId')) {
            throw new HttpInternalServerErrorException('notebookId parameter is missing');
        }

        $notebookId = $this->request->get('notebookId');
        $notebook   = (new NotebooksRepository())->find($notebookId);

        return $this->render('notebooks.show', compact('notebook'));
    }
}
