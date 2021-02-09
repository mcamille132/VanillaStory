<?php

namespace App\Controller;

use App\Model\UserManager;

class SecurityController extends AbstractController
{
    public function login()
    {
        $userManager = new UserManager();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
                $user = $userManager->selectOneByEmail($_POST['email']);
                if ($user) {
                    if ($user->pwd === md5($_POST['pwd'])) {
                        $_SESSION['id'] = $user->id;
                        $_SESSION['role'] = $user->role_id ;
                        if ($user->role_id == 1) {
                            header('Location:/admin/index');
                        } else {
                            header('Location:/home/index');
                        }
                    } else {
                        $error = 'Password wrong !';
                    }
                } else {
                    $error = 'User not found';
                }
            } else {
                $error = 'All fiel are required!';
            }
        }
        return $this->twig->render('Security/login.html.twig', ['error' => $error]);
    }

    public function register()
    {
        $userManager = new UserManager();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['firstname']) &&
                !empty($_POST['lastname']) &&
                !empty($_POST['street']) &&
                !empty($_POST['city']) &&
                !empty($_POST['email']) &&
                !empty($_POST['pwd']) &&
                !empty($_POST['pwd2'])
            ) {
                $user = $userManager->selectOneByEmail($_POST['email']);
                if ($user) {
                    $error = 'Email already exist';
                }
                if ($_POST['pwd'] != $_POST['pwd2']) {
                    $error = 'Password do not match';
                }
                if ($error === null) {
                    $user = [
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'street' => $_POST['street'],
                        'city' => $_POST['city'],
                        'email' => $_POST['email'],
                        'pwd' => md5($_POST['pwd']),
                        'role_id' => 2
                    ];
                    $userId = $userManager->insert($user);
                    $user = $userManager->selectOneById($userId);
                    if ($user) {
                        $_SESSION['user'] = $user;
                        header('Location:/');
                    }
                }
            }
        }
        return $this->twig->render('Security/register.html.twig', ['error' => $error]);
    }

    /**
     * Display infos $user
     */
    public function account()
    {
        return $this->twig->render('User/account.html.twig', ['user' => $this->getUser()]);
    }

    /**
     * Return $user
     */
    public function getUser()
    {
        $userManager = new UserManager();
        return $userManager->selectOneById($_SESSION['user']->id);
    }

    public function logout()
    {
        session_destroy();
        header('Location:/');
    }
}
