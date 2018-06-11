<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\News;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', [
            'controller_name' => 'Toutes les catégories',
            'category'=>$category
        ]);
    }


    /**
     * @Route("/category/{id}",name="category_show")
     */
    public function read($id){
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        return $this->render('category/detail.html.twig', array(
            'category'=>$category,
        ));
    }
}
