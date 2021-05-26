<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends AbstractController
{
    public function list(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy(['active' => true], ['id' => 'desc']);

        return $this->render('articles.html.twig', [
            'articles' => $articles,
        ]);
    }

    public function show(Article $article, ArticleRepository $articleRepository): Response
    {
        $similarArticles = $articleRepository->findSimilar($article, 4);

        return $this->render('article.html.twig', [
            'article' => $article,
            'similarArticles' => $similarArticles,
        ]);
    }

    public function showOld(Article $article): RedirectResponse
    {
        return $this->redirectToRoute('articles_show', ['slug' => $article->getSlug()], 301);
    }
}
