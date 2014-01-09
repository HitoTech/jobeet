<?php

namespace Pv\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pv\JobeetBundle\Entity\Category;

class CategoryController extends Controller
{
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('PvJobeetBundle:Category')->findOneBySlug($slug);

        if(!$category) {
            throw $this->createNotFoundException('Unable to find Category entity');
        }

        $category->setActiveJobs($em->getRepository('PvJobeetBundle:Job')->getActiveJobs($category->getId()));

        return $this->render('PvJobeetBundle:Category:show.html.twig', array(
            'category' => $category
        ));
    }
}