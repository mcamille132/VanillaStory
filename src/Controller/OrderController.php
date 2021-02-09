<?php


namespace App\Controller;

use App\Model\OrderManager;
use App\Model\UserManager;

/**
 * Class OrderController
 *
 */
class OrderController extends AbstractController
{


    /**
     * Display order listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $orderManager = new OrderManager();
        $orders = $orderManager->selectAllWithDetail();

        return $this->twig->render('Order/index.html.twig', ['orders' => $orders]);
    }
}
