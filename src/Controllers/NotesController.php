<?php

namespace App\Controllers;

use App\Foundation\FileSystem;
use App\Foundation\Http\Exceptions\HttpInternalServerErrorException;
use App\Foundation\Http\Response;

class NotesController extends Controller
{
    public function createAction(): Response
    {
        if (!$this->request->has('notebookId')) {
            throw new HttpInternalServerErrorException('notebookId is missing');
        }

        // TODO: add support for DI for methods to inject deps
        $fs      = new FileSystem();
        $content = $fs->read(app()->getViewPath() . '/notes/content.phtml');

        return $this->render('notes.create', [
            'notebookId' => $this->request->get('notebookId'),
            'content'    => $content->toString(),
        ]);
    }
}
