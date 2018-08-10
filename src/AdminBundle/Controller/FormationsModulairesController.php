<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormationsModulairesController extends Controller
{
    /**
     * @Route("/formationsmodulaires/index", name="formations_modulaires_index")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:FormationsModulaires:index.html.twig', array(
            // ...
        ));
    }

}
