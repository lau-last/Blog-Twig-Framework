<?php

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\UserManager;
use Core\Controller\Controller;
use Core\Http\Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class CommentController extends Controller
{


    public function postComment($articleId): void
    {
        $articleId = implode($articleId);
        $request = new Request();
        (new CommentManager())->createComment($request->getPost(), $articleId);
        $this->redirect("/articles/$articleId");

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showAll(): void
    {
        if (UserManager::userIsAdmin()) {
            $data['comments'] = (new CommentManager())->getAllComments();
            $this->render('management-comment.twig', $data);
            return;
        }

        $this->redirect('/403');

    }


    public function setValidComment($id): void
    {
        (new CommentManager())->updateCommentSetValid($id);
        $this->redirect('/comment-management');

    }


    public function doDeleteComment($id): void
    {
        (new CommentManager())->deleteComment($id);
        $this->redirect('/comment-management');

    }


}
