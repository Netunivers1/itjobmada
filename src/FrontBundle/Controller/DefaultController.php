<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * Matches /blog exactly
     *
     * @Route("/", name="front_homepage")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }
}
