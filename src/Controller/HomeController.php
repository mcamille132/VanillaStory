<?php

namespace App\Controller;

use App\Model\ProductManager;
use App\Model\PictureManager;
use App\Model\SizeManager;
use App\Model\CategoryManager;
use App\Service\CartService;
use App\Service\FilterService;
use App\Model\FaqManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function homepage()
    {
        return $this->twig->render('Home/homepage.html.twig');
    }

    public function homeabout()
    {
        return $this->twig->render('Home/homeabout.html.twig');
    }

    public function homecontact()
    {
        return $this->twig->render('Home/homecontact.html.twig');
    }

    public function send()
    {
        return $this->twig->render('Home/send.html.twig');
    }

    public function faq()
    {
        $faqManager = new FaqManager();
        $faqs = $faqManager->selectAll();

        return $this->twig->render('Home/faq.html.twig', ['faqs' => $faqs]);
    }

    public function index()
    {
        $result = [];
        $imgDefault = "https://i.ibb.co/Lv9x6rf/https-i-ibb-co-N2-DYXVB-vanilla-expensive-jpg.jpg";
        $imgHeader = null;
        $cartService = new CartService();
        $filterService = new FilterService();
        $pictureManager = new PictureManager();
        $pictures = $pictureManager->selectAll();

        $sizeManager = new SizeManager();
        $sizes = $sizeManager->selectAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();

        $productManager = new ProductManager();
        $products = $productManager->selectAllWithDetail();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['add_article'])) {
                $product = $_POST['add_article'];
                $cartService->add($product);
            } else {
                $result = $products;
            }

            if (isset($_POST['category_id'])) {
                $imgHeader = $categoryManager->selectOneById($_POST['category_id'])['img'];
                $products = $filterService->getProductFromSearch($_POST);
            }

            // if (isset($_POST['size_id'])) {
            //     $products = $filterService->getProductFromSearch($_POST);
            // }
        }
        return $this->twig->render('Home/index.html.twig', [
            'products' => $products,
            'pictures' => $pictures,
            'categories' => $categories,
            'sizes' => $sizes,
            'header' => $imgHeader ? $imgHeader : $imgDefault
        ]);
    }

    public function show(int $id)
    {
        $cartService = new CartService();
        $productManager = new ProductManager();
        $product = $productManager->selectOneWithDetails($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['add_article'])) {
                $product = $_POST['add_article'];
                $cartService->add($product);
            }
        }
        return $this->twig->render('Home/show.html.twig', ['product' => $product]);
    }

    public function cart(int $id = null)
    {
        $cartService = new CartService();
        $errorForm = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update_cart'])) {
                $cartService->update($_POST);
            }            if (isset($_POST['payment'])) {
                if (!empty($_POST['firstname']) && !empty($_POST['address'])) {
                    $cartService->payment($_POST);
                } else {
                    $errorForm = "All field are required !";
                }
            }
        }        if ($id != null) {
            $article = $id;
            $cartService->delete($article);
        }
        return $this->twig->render('Home/cart.html.twig', [
            'cartInfos' => $cartService->cartInfos() ? $cartService->cartInfos() : null,
            'total' => $cartService->cartInfos() ? $cartService->totalCart() : null,
            'errorForm' => $errorForm
        ]);
    }

    public function success()
    {
        return $this->twig->render('Home/success.html.twig');
    }
}
