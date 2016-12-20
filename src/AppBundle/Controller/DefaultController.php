<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('default/index.html.twig',['categories'=>$categories]);
    }

    /**
     * @Route("/category/{id}", name="category_id")
     * @param $id
     * @return Response
     */
    public function categoryId($id){
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $pictures = $category->getPictures();
        return $this->render('default/category.html.twig',['pictures'=>$pictures]);
    }
}
