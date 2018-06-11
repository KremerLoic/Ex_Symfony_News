<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Author::class);
        $author = $repository->findAll();


        return $this->render('author/index.html.twig', [
            'controller_name' => 'Liste des auteurs',
            'authors'=>$author
        ]);
    }

    /**
     * @Route("/author/{id}", name="author_show")
     */

    public function read($id)
    {
        $repository = $this->getDoctrine()->getRepository(Author::class);
        $author = $repository->find($id);


        return $this->render('author/detail.html.twig',array(
           'author'=>$author,
        ));

    }
}
