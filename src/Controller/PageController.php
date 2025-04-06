<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/cv', name: 'app_cv')]
    public function cv(): Response
    {
        return $this->render('page/cv.html.twig');
    }

    #[Route('/loisirs', name: 'app_loisirs')]
    public function loisirs(): Response
    {
        return $this->render('page/loisirs.html.twig');
    }
} 