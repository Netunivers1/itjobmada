<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller {

    /**
     * Matches /blog exactly
     *
     * @Route("/", name="admin_homepage")
     */
    public function indexAction() {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
}
