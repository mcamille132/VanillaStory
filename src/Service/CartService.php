<?php

namespace App\Service;

use Stripe\Stripe;
use App\Model\ProductManager;
use App\Model\OrderManager;
use App\Model\OrderDetailManager;

class CartService
{
    public function add($article)
    {
        if (!empty($_SESSION['cart'][$article])) {
            $_SESSION['cart'][$article]++;
        } else {
            $_SESSION['cart'][$article] = 1;
        }
        $_SESSION['count'] = $this->countArticle();
        header('Location:/');
    }

    public function update(array $array)
    {
        $articleManager = new ProductManager();
        for ($i = 0; $i < count($array['id']); $i++) {
            $article = $articleManager->selectOneWithDetails($array['id'][0]);
            foreach ($_SESSION['cart'] as $id => $qty) {
                $newCount = $article['quantity'] - $array['quantity'][$i];
                if ($newCount >= 0) {
                    $_SESSION['cart'][$array['id'][$i]] = $array['quantity'][$i];
                } else {
                    $_SESSION['flash_message'] = ["This article is only available in a smaller amount"];

                    header('Location:/home/cart/');
                }
            }
        }
        header('Location:/home/cart');
    }

    public function delete($article)
    {
        $cart = $_SESSION['cart'];
        if (!empty($cart[$article])) {
            unset($cart[$article]);
        }
        $_SESSION['cart'] = $cart;
        $_SESSION['count'] = $this->countArticle();
        header('Location:/home/cart');
    }

    public function cartInfos()
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $cartInfos = [];
            $articleManager = new ProductManager();
            foreach ($cart as $id => $qty) {
                $infosArticle = $articleManager->selectOneWithdetails($id);

                $infosArticle['quantity'] = $qty;
                $cartInfos[] = $infosArticle;
            }
            return $cartInfos;
        }
        return false;
    }

    public function totalCart()
    {
        $total = 0;
        if ($this->cartInfos() != false) {
            foreach ($this->cartInfos() as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return $total;
        }
        return $total;
    }

    public function countArticle()
    {
        $total = 0;
        if ($this->cartInfos() != false) {
            foreach ($this->cartInfos() as $item) {
                $total += $item['quantity'];
            }
            return $total;
        }
        return $total;
    }

    public function payment($infos)
    {
        $orderManager = new OrderManager();
        $orderDetailManager = new OrderDetailManager();
        $productManager = new ProductManager();
        $stripe = \Stripe\Stripe::setApiKey(API_KEY);

        $data = [
            'user_id' => $_SESSION['id'],
            'total' => $this->totalCart(),
            'created_at' => date("Y-m-d")
        ];

        $orderId = $orderManager->insert($data);
        foreach ($this->cartinfos() as $article) {
            $status = isset($_POST['status']) ? true : false;
            $detail = [
                'quantity' => $article['quantity'],
                'product_id' => $article['id'],
                'order_id' => $orderId,
                'user_id' => $_SESSION['id'],
                'status' => $status,
                'total' => $article['price'] * $article['quantity']
            ];
            $orderDetailManager->insert($detail);
        }

        try {
            $data = [
                'source' => $_POST['stripeToken'],
                'description' => $_POST['lastname'],
                'email' => $_POST['email']
            ];
            $customer = \Stripe\Customer::create($data);

            $charge = \Stripe\Charge::create([
                'amount' => $this->totalCart() * 100,
                'currency' => 'gbp',
                'description' => 'Example charge',
                'customer' => $customer->id,
                'statement_descriptor' => 'Custom descriptor',
            ]);

            unset($_SESSION['cart']);
            unset($_SESSION['count']);
            $_SESSION['transaction'] = $charge->receipt_url;
            header('Location:/home/success');
        } catch (\Stripe\Exception\ApiErrorException $e) {
        }
    }
}
