<?php

namespace App\Controller;

use App\Entity\Article;
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
     * @Route("/article/{id}", name="app_article", methods="GET")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Article $article)
    {
        return $this->render('article/article.html.twig', [
            'article' => $article,
        ]);
    }
}
