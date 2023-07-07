<?php

namespace App\Controller;

use Core\Controller\Controller;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class ErrorController extends Controller
{


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function show403(): void
    {
        $this->render('403.twig');

    }


}
