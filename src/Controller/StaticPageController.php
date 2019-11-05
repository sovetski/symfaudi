<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticPageController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact()
    {
        return $this->render('static_page/contact.html.twig', [
            'controller_name' => 'StaticPageController',
        ]);
    }
}
