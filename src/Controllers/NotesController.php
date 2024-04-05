<?php

namespace App\Controllers;

use App\Entities\Note;
use App\Foundation\FileSystem;
use App\Foundation\Http\Exceptions\HttpInternalServerErrorException;
use App\Foundation\Http\Exceptions\HttpMethodNotAllowedException;
use App\Foundation\Http\Exceptions\HttpNotFoundException;
use App\Foundation\Http\Response;
use App\Repositories\NotesRepository;

class NotesController extends Controller
{
    public function showAction(): Response
    {
        if (!$this->request->has('noteId')) {
            throw new HttpNotFoundException('Note is not found');
        }

        $note = (new NotesRepository())->find($this->request->get('noteId'));

        return $this->render('notes.show', compact('note'));
    }

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

    public function storeAction(): Response
    {
        if (!$this->request->isPost()) {
            throw new HttpMethodNotAllowedException("{$this->request->getMethod()} is not allowed for this route!");
        }

        $notebookId = $this->request->post('notebookId');
        $note       = new Note();
        $note
            ->setNotebookId($notebookId)
            ->setTitle($this->request->post('title'))
            ->setContent($this->request->post('content'))
            ->setCreatedAt($this->request->post('createdAt'));

        (new NotesRepository())->save($note);
        $this->redirectToUrl("/notebooks?notebookId=$notebookId");
    }

    /**
     * @throws HttpNotFoundException
     * @throws HttpInternalServerErrorException
     */
    public function deleteAction(): Response
    {
        if (!$this->request->has('noteId')) {
            throw new HttpNotFoundException('Note is not found');
        }

        /** @var Note $note */
        $repository = new NotesRepository();
        $note       = $repository->find($this->request->get('noteId'));
        $op         = $repository->delete($note->getId());

        if ($op) {
            $this->redirectToUrl("/notebooks?notebookId={$note->getNotebookId()}");
        } else {
            throw new HttpInternalServerErrorException('Failed to delete note');
        }
    }
}
