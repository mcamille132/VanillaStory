<?php

namespace App\Controller;

use App\Model\AboutManager;

class AboutController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function homeabout()
    {
        return $this->twig->render('about/homeabout.html.twig');
    }