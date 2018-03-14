<?php

namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EcoleController extends Controller
{
    /**
     * @Route("/ecole/", name="admin_homepage")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Ecole:index.html.twig');
    }
}