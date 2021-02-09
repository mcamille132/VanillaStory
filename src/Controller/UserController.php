<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{

    /**
     * Display account user page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function account()
    {
        if (!isset($_SESSION['id'])) {
            header('Location:/security/login');
        }
        $userManager = new UserManager();
        $user = $userManager->selectOneWithDetails($_SESSION['id']);
        return $this->twig->render('User/edit.html.twig', [
            'user' => $user
            ]);
    }

    public function edit()
    {
        $error = null;
        if (!isset($_SESSION['id'])) {
            header('Location:/security/login');
        } else {
            $userManager = new UserManager();
            $user = $userManager->selectOneWithDetails($_SESSION['id']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['pwd'] != $_POST['pwd2']) {
                    $error = 'Password do not match';
                }
                if ($error === null) {
                    $user = [
                    'id' => $_POST['id'],
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'pwd' => md5($_POST['pwd']),
                    'street' => $_POST['street'],
                    'city' => $_POST['city'],
                    'email' => $_POST['email'],
                    ];
                    $userManager->update($user);
                    header('Location:/user/account/');
                }
            }
            return $this->twig->render('User/edit.html.twig', [
            'user' => $user
            ]);
        }
    }
    public function index()
    {
        $userManager = new UserManager();
        $users = $userManager->selectAllWithDetails();
        return $this->twig->render('User/index.html.twig', ['users' => $users]);
    }
}
