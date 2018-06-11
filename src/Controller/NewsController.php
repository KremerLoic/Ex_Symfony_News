<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\News;
use App\Form\NewsFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    /**
     * @Route("/news", name="news")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(News::class);
        $news = $repository->findAll();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'Toutes les news',
            'news' => $news
        ]);
    }


    /**
     * @Route("/news/create" , name="news_create")
     */


    public function create(Request $request){
        $news = new News();
        $form = $this->createForm(NewsFormType::class,$news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news');
        }

        return $this->render('news/create.html.twig', array(
           'form'=>$form->createView()
        ));
    }


    /**
     * @Route("/news/edit/{id}", name="news_update")
     */

    public function update(Request $request, News $newsOne ){
        $news = new News();
        $news = $newsOne;

        $form = $this->createForm(NewsFormType::class,$news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news');
        }
        return $this->render('news/edit.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/news/delete/{id}", name="news_delete");
     */

    public function delete($id){
        $repository = $this->getDoctrine()->getRepository(News::class);
        $news = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('news');



    }


    /**
     * @Route("/news/{id}/add-author-2", name="news_add_author_2")
     */
    public function setAuthor2ToNews($id){
        $news = $this->getDoctrine()->getRepository(News::class)->find($id);
        $author = $this->getDoctrine()->getRepository(Author::class)->findOneBy(['id'=>26]);

        $news->setAuthor($author);

        $em = $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();

        return $this->redirectToRoute('news');

    }

    /**
     * @Route("/news/{id}/add-cat-2", name="news_add_cat_2")
     */

    public function setCat2ToNews($id){
        $news = $this->getDoctrine()->getRepository(News::class)->find($id);
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['id'=>1]);

        $news->addCategory($category);
        $category->addNews($news);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($news);
        $em->flush();

        return $this->redirectToRoute('news');

    }


}

