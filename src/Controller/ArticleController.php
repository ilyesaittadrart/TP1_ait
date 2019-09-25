<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="articles_index")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();
        
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Permet d'afficher un seule article
     * 
     * @Route("/articles/{id}", name="article_show")
     *
     * 
     * @return Response
     */
    public function show(Article $article)
    {
        return $this->render('article/show.html.twig',[
            'article' => $article
        
        ]);
    }
}
