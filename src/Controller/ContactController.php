<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function homecontact()
    {
        return $this->twig->render('contact/homecontact.html.twig');
    }
}