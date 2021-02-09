<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */
namespace App\Controller;

use App\Model\BlogImageManager;
use App\Model\BlogArticleManager;

/**
 * Class BlogImageController
 *
 */
class BlogImageController extends AbstractController
{
    /**
     * Display BlogImage listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $blogImageManager = new BlogImageManager();
        $blogImages = $blogImageManager->selectAll();

        return $this->twig->render('BlogImage/index.html.twig', ['blogImages' => $blogImages]);
    }
    /**
     * Display BlogImage informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $blogImageManager = new BlogImageManager();
        $blogImage = $blogImageManager->selectOneById($id);

        return $this->twig->render('BlogImage/show.html.twig', ['blogImage' => $blogImage]);
    }
    /**
     * Display BlogImage edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $blogImageManager = new BlogImageManager();
        $blogImage = $blogImageManager->selectOneById($id);
        $blogArticleManager = new BlogArticleManager();
        $blogArticles = $blogArticleManager->selectAllWithImg();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['blogArticle_id'])) {
                $_POST['blogArticle_id'] = null;
            }
            $blogImage = [
                'id' => $_POST['id'],
                'link' => $_POST['link'],
                'blogArticle_id' => $_POST['blogArticle_id'],
            ];

            $blogImageManager->update($blogImage);
            header('Location:/blogImage/show/' . $id);
        }

        return $this->twig->render('BlogImage/edit.html.twig', [
            'blogImage' => $blogImage,
            'blogArticles' => $blogArticles
            ]);
    }
    /**
     * Display BlogImage creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $blogArticleManager = new BlogArticleManager();
        $blogArticles = $blogArticleManager->selectAllWithImg();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blogImageManager = new BlogImageManager();
            if (empty($_POST['blogArticle_id'])) {
                $_POST['blogArticle_id'] = null;
            }
            $blogImage = [
                'link' => $_POST['link'],
                'blogArticle_id' => $_POST['blogArticle_id'],
            ];
            $id = $blogImageManager->insert($blogImage);
            header('Location:/blogimage/show/' . $id);
        }

        return $this->twig->render('BlogImage/add.html.twig', [
            'blogArticles' => $blogArticles
        ]);
    }
    /**
     * Handle BlogImage deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $blogImageManager = new BlogImageManager();
        $blogImageManager->delete($id);
        header('Location:/blogImage/index');
    }

    public function link(int $id)
    {
        $blogImageManager = new BlogImageManager();
        $blogImage = $blogImageManager->selectOneById($id);
            
        return json_encode($blogImage);
    }
}
