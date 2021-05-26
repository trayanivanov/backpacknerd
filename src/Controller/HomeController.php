<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function index(ArticleRepository $articleRepository): Response
    {
        $favouriteArticles = $articleRepository->findBy(['active' => true, 'favourite' => true], ['createdAt' => 'desc'], 8);

        return $this->render('home.html.twig', [
            'favouriteArticles' => $favouriteArticles,
        ]);
    }
}
