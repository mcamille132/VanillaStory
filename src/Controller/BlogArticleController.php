<?php

namespace App\Controller;

use App\Model\BlogArticleManager;
use App\Model\BlogImageManager;

/**
 * Class BlogArticleController
 *
 */
class BlogArticleController extends AbstractController
{
    /**
     * Display blogArticle listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $blogArticleManager = new BlogArticleManager();
        $blogArticles = $blogArticleManager->selectAllWithImg();
        return $this->twig->render('BlogArticle/index.html.twig', ['blogArticles' => $blogArticles]);
    }
    
    /**
     * Display blogArticle informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $blogArticleManager = new BlogArticleManager();
        $blogArticle = $blogArticleManager->selectOneWithImg($id);
        return $this->twig->render('BlogArticle/show.html.twig', ['blogArticle' => $blogArticle]);
    }
    /**
     * Display blogArticle edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $blogArticleManager = new BlogArticleManager();
        $blogArticle = $blogArticleManager->selectOneWithImg($id);
        $blogImageManager = new BlogImageManager();
        $blogImages = $blogImageManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blogArticle = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
            ];
            $blogArticleManager->update($blogArticle);
            header('Location:/blogArticle/show/' . $id);
        }
        return $this->twig->render('BlogArticle/edit.html.twig', [
            'blogArticle' => $blogArticle,
            'blogImages' => $blogImages
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
        $blogImageManager = new BlogImageManager();
        $blogImages = $blogImageManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blogArticleManager = new BlogArticleManager();
            $blogArticle = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
            ];
            $id = $blogArticleManager->insert($blogArticle);
            $blogImage =[
                "link"=> $_POST['link'],
                "blogArticle_id"=> $id
            ];

            $blogImageManager = new BlogImageManager();
            $blogImageManager->insert($blogImage);
            header('Location:/blogArticle/show/' . $id);
        }
        return $this->twig->render('BlogArticle/add.html.twig', [
            'blogImages' => $blogImages
        ]);
    }
    /**
     * Handle product deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $blogArticleManager = new BlogArticleManager();
        $blogArticleManager->delete($id);
        header('Location:/blogArticle/index');
    }
}
