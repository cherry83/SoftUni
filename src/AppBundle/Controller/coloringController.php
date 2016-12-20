<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Picture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class coloringController extends Controller
{
    /**
     * @Route ("/coloring", name="coloring")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ColoringDefault()
    {
        $id = "colours_053-by_endi.png";
        return $this->render('coloring.html.twig',['outline'=>$id]);
    }

    /**
     * @Route ("/coloring/{id}", name="coloring_id")
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Coloring($id)
    {
        $picture = $this->getDoctrine()->getRepository(Picture::class)->find($id);
        return $this->render('coloring.html.twig',['outline'=>$picture->getFile()]);
    }
}
