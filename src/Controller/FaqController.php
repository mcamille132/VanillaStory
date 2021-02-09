<?php

namespace App\Controller;

use App\Model\FaqManager;

/**
 * Class FaqController
 *
 */
class FaqController extends AbstractController
{


    /**
     * Display faq listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $faqManager = new FaqManager();
        $faqs = $faqManager->selectAll();

        return $this->twig->render('Faq/index.html.twig', ['faqs' => $faqs]);
    }


    /**
     * Display faq informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $faqManager = new FaqManager();
        $faq = $faqManager->selectOneById($id);

        return $this->twig->render('Faq/show.html.twig', ['faq' => $faq]);
    }


    /**
     * Display faq edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $faqManager = new FaqManager();
        $faq = $faqManager->selectOneById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $faq = [
                'id' => $_POST['id'],
                'question' => $_POST['question'],
                'answer' => $_POST['answer']
            ];
            
            $faqManager->update($faq);
            header('Location:/faq/show/' . $id);
        }

        return $this->twig->render('Faq/edit.html.twig', [
            'faq' => $faq
            // 'faqs' => $faqs
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
        $faqManager = new FaqManager();
        $faqs = $faqManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $faqManager = new FaqManager();
            $faq = [
                'id' => $_POST['id'],
                'question' => $_POST['question'],
                'answer' => $_POST['answer']
            ];
            $id = $faqManager->insert($faq);
            header('Location:/faq/show/' . $id);
        }

        return $this->twig->render('Faq/add.html.twig', [
            'faqs' => $faqs
        ]);
    }


    /**
     * Handle faq deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $faqManager = new FaqManager();
        $faqManager->delete($id);
        header('Location:/faq/index');
    }
}
