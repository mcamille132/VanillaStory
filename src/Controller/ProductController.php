<?php

namespace App\Controller;

use App\Model\ProductManager;
use App\Model\CategoryManager;
use App\Model\SizeManager;
use App\Model\PictureManager;

/**
 * Class ProductController
 *
 */
class ProductController extends AbstractController
{
    /**
     * Display product listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $productManager = new ProductManager();
        $products = $productManager->selectAllWithDetail();
        return $this->twig->render('Product/index.html.twig', ['products' => $products]);
    }
    /**
     * Display product informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $productManager = new ProductManager();
        $product = $productManager->selectOneWithDetails($id);
        return $this->twig->render('Product/show.html.twig', ['product' => $product]);
    }
    /**
     * Display product edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $productManager = new ProductManager();
        $product = $productManager->selectOneWithDetails($id);
        $sizeManager = new SizeManager();
        $sizes = $sizeManager->selectAll();
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activated = isset($_POST['activated']) ? true : false;
            $product = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'category_id' => $_POST['category_id'],
                'size_id' => $_POST['size_id'],
                'price' => $_POST['price'],
                'content' => $_POST['content'],
                'activated' => $activated,
            ];
            $productManager->update($product);
            header('Location:/product/show/' . $id);
        }
        return $this->twig->render('Product/edit.html.twig', [
            'product' => $product,
            'categories' => $categories,
            'sizes' => $sizes
        ]);
    }
    /**
     * Display specie creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $sizeManager = new SizeManager();
        $sizes = $sizeManager->selectAll();
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activated = isset($_POST['activated']) ? true : false;
            $productManager = new ProductManager();
            $product = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'category_id' => $_POST['category_id'],
                'size_id' => $_POST['size_id'],
                'price' => $_POST['price'],
                'content' => $_POST['content'],
                'activated' => $activated,
            ];
            $id = $productManager->insert($product);
            $picture =[
                "url"=> $_POST['picture'],
                "product_id"=> $id
            ];

            $pictureManager = new PictureManager();
            $pictureManager->insert($picture);
            header('Location:/product/show/' . $id);
        }
        return $this->twig->render('Product/add.html.twig', [
            'categories' => $categories,
            'sizes' => $sizes
        ]);
    }
    /**
     * Handle product deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $productManager = new ProductManager();
        $productManager->delete($id);
        header('Location:/product/index');
    }
}
