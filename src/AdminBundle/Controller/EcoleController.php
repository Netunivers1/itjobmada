<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Epizy_ecole;
use AppBundle\Form\EpizyecoleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EcoleController extends Controller {
    /**
     * @Route("/ecole/index", name="ecole_homepage")
     */
    public function indexAction()
    {
        // Get all ecole
        $ecole = $this->getDoctrine()->getRepository(Epizy_ecole::class)->findAll();

        return $this->render('AdminBundle:Ecole:index.html.twig', ['ecole' => $ecole]);
    }

    /**
     * @Route("/ecole/new", name="ecole_new")
     */
    public function newecoleAction(Request $request)
    {
        $form = $this->createForm(EpizyecoleType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new_ecole = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($new_ecole);
            $entityManager->flush();
        }

        return $this->render('AdminBundle:Ecole:new-ecole.html.twig', ['form' => $form->createView()]);
    }
}