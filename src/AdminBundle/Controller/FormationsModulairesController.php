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
    	$lists = [];
    	for ($i=0; $i < 1500; $i++) { 
    		$tmp = [
    			"Rendering" => "$i -- Trident",
    			"Browser" => "$i -- Internet",
    			"Platform" => "$i -- Win 95+",
    			"Engine" => "$i -- 4",
    			"CSS" => "$i -- X"
    		];
    		$lists[] = $tmp;
    	}
    	$lists = [];
        return $this->render('AdminBundle:FormationsModulaires:index.html.twig', array(
            "lists" => $lists
        ));
    }

}
