<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="app_admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("/new/article", name="_new_article")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newArticle(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article, [
            'validation_groups' => ['Default','new']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            return $this->persistArticle($article, 'Le nouvel article a bien été crée');
        }

        return $this->render('admin/article.new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/article/{id}/edit", name="_article_edit", requirements={"id": "\d+"}, methods={"GET", "POST"})
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editArticle(Request $request, Article $article)
    {
        $form = $this->createForm(ArticleType::class, $article, [
            'full' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            return $this->persistArticle($article, 'L\'article à bien été modifié !');
        }

        return $this->render('admin/article.edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article/{id}/delete", name="_article_delete", requirements={"id": "\d+"}, methods={"GET", "POST"})
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteArticle(Article $article)
    {
        return $this->removeArticle($article, 'L\'article à bien été supprimé !');
    }

    private function removeArticle(Article $article, string $message)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $this->addFlash('success', $message);

        return $this->redirectToRoute('app_index');
    }

    private function persistArticle(Article $article, string $message)
    {

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $this->addFlash('success', $message);

        return $this->redirectToRoute('app_article', [
            'id' => $article->getId()
        ]);
    }
}
