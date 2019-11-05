<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     * @param ArticleRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findALl();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/article", name="app_article")
     */
    public function article()
    {
        return $this->render('article/article.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
