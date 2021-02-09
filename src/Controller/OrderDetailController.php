<?php

namespace App\Controller;

use App\Model\OrderDetailManager;
use App\Model\OrderManager;
use App\Model\ProductManager;
use App\Model\UserManager;

/**
 * Class OrderDetailController
 *
 */
class OrderDetailController extends AbstractController
{
    /**
     * Display orderDetail informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $orderDetailManager = new OrderDetailManager();
        $orderDetail = $orderDetailManager->selectOneWithDetails($id);
        
        return $this->twig->render('OrderDetail/show.html.twig', ['orderDetail' => $orderDetail]);
    }
    
    /**
     * Display orderDetail edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id)
    {
        $orderDetailManager = new OrderDetailManager();
        $orderDetail = $orderDetailManager->selectOneWithDetails($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = isset($_POST['status']) ? true : false;
            $orderDetail = [
                'id' => $_POST['id'],
                'status' => $status
            ];

            $orderDetailManager->update($orderDetail);
            header('Location:/orderDetail/show/' . $id);
        }

        return $this->twig->render('OrderDetail/edit.html.twig', [
            'orderDetail' => $orderDetail
        ]);
    }

    public function add()
    {
        $orderManager = new OrderManager();
        $orders = $orderManager->selectAllWithDetail();

        $productManager = new ProductManager();
        $products = $productManager->selectAllWithDetail();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = isset($_POST['status']) ? true : false;
            $orderDetailManager = new OrderDetailManager();
            $orderDetail = [
                'quantity' => $_POST['quantity'],
                'total' => $_POST['total'],
                'order_id' => $_POST['order_id'],
                'status' => $status,
                'product_id' => $_POST['product_id']
            ];
            $id = $orderDetailManager->insert($orderDetail);
            header('Location:/orderDetail/show/' . $id);
        }
        return $this->twig->render('OrderDetail/add.html.twig', [
            'orders' => $orders,
            'products' => $products,
            'orderDetail' => $orderDetail
        ]);
    }
}
