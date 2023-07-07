<?php

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\ArticleManager;
use App\Manager\UserManager;
use Core\Controller\Controller;
use Core\Http\Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class ArticleController extends Controller
{


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showAll(): void
    {
        $data['articles'] = (new ArticleManager())->getArticles();
        $data['notificationArticleManagement'] = \App\Manager\Notification::notificationArticleManagement();
        $this->render('show-all-articles.twig', $data);

    }


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function show($id): void
    {
        $data['article'] = (new ArticleManager())->getArticle($id);
        $data['comments'] = (new CommentManager())->getCommentFromArticle($id);
        $this->render('show-article.twig', $data);

    }


    public function postArticle(): void
    {
        $request = new Request();
        (new ArticleManager())->createArticle($request->getPost());
        $this->redirect('/articles');

    }


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function modifyArticle(): void
    {
        if (UserManager::userIsAdmin()) {
            $data['articles'] = (new ArticleManager())->getArticles();
            $data['notificationArticleManagement'] = \App\Manager\Notification::notificationArticleManagement();
            $this->render('management-article.twig', $data);
            return;
        }

        $this->redirect('/403');

    }


    public function doModifyArticle($id): void
    {
        $request = new Request();
        (new ArticleManager())->updateArticle($request->getPost(), $id);
        $this->redirect('/article-management');

    }


    public function doDeleteArticle($id): void
    {
        (new ArticleManager())->deleteArticle($id);
        $this->redirect('/article-management');

    }


}
