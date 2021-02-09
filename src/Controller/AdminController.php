<?php

namespace App\Controller;

use App\Model\ProductManager;
use App\Model\OrderManager;
use App\Model\UserManager;

class AdminController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    
    
    public function index()
    {
        $orderManager = new OrderManager();
        $productManager = new ProductManager();
        $userManager = new UserManager();
        $products = $productManager->selectAllWithDetail();
        $orders = $orderManager->selectAllWithDetail();
        $users = $userManager->selectAll();

        return $this->twig->render('Admin/index.html.twig', [
            'products' => $products,
            'orders' => $orders,
        ]);

        header('Location:/admin/index');
    }
}
