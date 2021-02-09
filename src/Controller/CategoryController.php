<?php

namespace App\Controller;

use App\Model\CategoryManager;

/**
 * Class CategoryController
 *
 */
class CategoryController extends AbstractController
{


    /**
     * Display category listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();

        return $this->twig->render('Category/index.html.twig', ['categories' => $categories]);
    }


    /**
     * Display category informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneById($id);

        return $this->twig->render('Category/show.html.twig', ['category' => $category]);
    }


    /**
     * Display category edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = [
                'id' => $_POST['id'],
                'name' => $_POST['name']
            ];
            
            $categoryManager->update($category);
            header('Location:/category/show/' . $id);
        }

        return $this->twig->render('Category/edit.html.twig', [
            'category' => $category
            // 'categories' => $categories
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
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryManager = new CategoryManager();
            $category = [
                'id' => $_POST['id'],
                'name' => $_POST['name']
            ];
            $id = $categoryManager->insert($category);
            header('Location:/category/show/' . $id);
        }

        return $this->twig->render('Category/add.html.twig', [
            'categories' => $categories
        ]);
    }


    /**
     * Handle category deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $categoryManager = new CategoryManager();
        $categoryManager->delete($id);
        header('Location:/category/index');
    }
}
