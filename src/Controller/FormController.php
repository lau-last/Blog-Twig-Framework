<?php

namespace App\Controller;

use App\Manager\ArticleManager;
use App\Manager\EmailManager;
use App\Manager\FormManager\FormConnection;
use App\Manager\FormManager\FormRegistration;
use App\Manager\UserManager;
use App\SessionBlog\SessionBlog;
use Core\Controller\Controller;
use Core\Http\Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class FormController extends Controller
{


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showFormConnection(): void
    {
        $this->render('connection.twig');

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function doConnection(): void
    {
        $form = new FormConnection();
        $request = new Request();
        if (!$form->registerSession($request->getPost())) {
            $data['error'] = 'The login or password is incorrect';
            $this->render('connection.twig', $data);
            return;
        }

        $this->redirect('/');

    }


    public function logout(): void
    {
        SessionBlog::destroy();
        $this->redirect('/');

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showFormRegistration(): void
    {
        $this->render('registration.twig');

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws \Exception
     */
    public function doRegistration(): void
    {
        $request = new Request();
        $registration = new FormRegistration();
        $errors = $registration->isValid($request->getPost());
        if (!empty($errors)) {
            $data['errors'] = $errors;
            $this->render('registration.twig', $data);
            return;
        }

        (new UserManager())->doPreRegistration($request->getPost());
        $messages = (new EmailManager())->doSendEmailValidation($request->getPost()) ? 'Message has been sent for validation' : 'Message could not be sent for validation retry please';
        $data['message'] = $messages;
        $this->render('registration.twig', $data);

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showFormCreationArticle(): void
    {
        if (UserManager::userIsAdmin()) {
            $this->render('creation-article.twig');
            return;
        }

        $this->redirect('/403');

    }


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function showFormModifyArticle($id): void
    {
        $data['article'] = (new ArticleManager())->getArticle($id);
        $this->render('modify-article.twig', $data);

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function sendEmail(): void
    {
        $request = new Request();
        $messages = (new EmailManager())->doSendEmailContact($request->getPost()) ? 'Message has been sent' : 'Message could not be sent';
        $data['messages'] = $messages;
        $this->render('home.twig', $data);

    }


}
