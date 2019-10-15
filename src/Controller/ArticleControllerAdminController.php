<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleControllerAdminController extends AbstractController
{
    /**
     * @Route("/admin/article", name="articles_index_admin")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('article/admin/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Permet de créer un article
     *
     * @Route("/admin/article/new", name="article_creation")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($article);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "L'article '{$article->getLibelle()}' a bien été enregistré !"
            );

            return $this->redirectToRoute('articles_index_admin',[
                
            ]);
        }

        return $this->render('article/admin/new.html.twig',[
            'form' => $form->createView()

        ]);
    
    }

        /**
     * Permet d'afficher le formulaire pour éditer un article
     *
     * @Route("/admin/article/{id}/edit", name="article_edit")
     * 
     * @return Response
     */
    public function edit(Article $article, Request $request, ObjectManager $manager){
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){


            $manager->persist($article);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "Les modifications de l'article '{$article->getLibelle()}' ont bien été enregistrées !"
            );

            return $this->redirectToRoute('articles_index_admin',[
                'id' => $article->getId()
            ]);
        }
        
        return $this->render('article/admin/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);

    }

    /**
     * Permet de supprimer un article
     * 
     * @Route("/admin/article/{id}/delete", name="article_delete")
     *
     * @return Response
     */
    public function delete(Article $article, ObjectManager $manager){
        $manager->remove($article);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article '{$article->getLibelle()}' a bien été supprimé !"
        );
        

        return $this->redirectToRoute("articles_index_admin");
    }

}
