<?php

namespace App\Controller;

use Core\Controller\Controller;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class HomeController extends Controller
{


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showHome(): void
    {
        $this->render('home.twig');

    }


}
