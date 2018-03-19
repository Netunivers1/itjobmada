<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Epizy_ecole;
use AppBundle\Form\EpizyecoleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EcoleController extends Controller
{
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

            return $this->redirectToRoute('ecole_homepage');
        }

        return $this->render('AdminBundle:Ecole:new-ecole.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(
     *     "/ecole/edit/{ecole_id}", name="ecole_edit",
     *     requirements={"ecole_id": "\d+"}
     *     )
     */
    public function editecoleAction(Request $request, $ecole_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $ecole = $entityManager->getRepository(Epizy_ecole::class)->find($ecole_id);

        $form = $this->createForm(EpizyecoleType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $ecole->setNom($form['nom']->getData());
            $ecole->setAdress($form['adress']->getData());
            $ecole->setBp($form['bp']->getData());
            $ecole->setEmail($form['email']->getData());
            $ecole->setRegion($form['region']->getData());
            $ecole->setTel($form['tel']->getData());
            $ecole->setNomResp($form['nom_resp']->getData());
            $ecole->setDiplReconnu($form['diplReconnu']->getData());
            $ecole->setPhoto($form['photo']->getData());
            $ecole->setSite($form['site']->getData());
            $ecole->setLienfb($form['lienfb']->getData());
            $entityManager->flush();

            return $this->redirectToRoute('ecole_homepage');
        }

        return $this->render('AdminBundle:Ecole:new-ecole.html.twig',
            [
                'form' => $form->createView(),
                'ecole' => $ecole
            ]
        );
    }

    /**
     * @Route("/ecole/delete/{ecole_id}", name="ecole_delete",
     *     requirements={"ecole_id": "\d+"}
     *     )
     */
    public function deleteecoleAction($ecole_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $ecole_to_delete = $entityManager->getRepository(Epizy_ecole::class)->find($ecole_id);
        $entityManager->remove($ecole_to_delete);
        $entityManager->flush();

        return $this->redirectToRoute('ecole_homepage');
    }

    /**
     * @Route("/ecole/changestatut/{status}/{ecole_id}", name="ecole_change_status",
     *     requirements={"ecole_id": "\d+", "statut": "\d+"}
     *     )
     */
    public function activateAnddeactivateAction($ecole_id, $status)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $ecole_to_change_status = $entityManager->getRepository(Epizy_ecole::class)->find($ecole_id);
        $ecole_to_change_status->setStatus((int)$status);
        $entityManager->flush();

        return $this->redirectToRoute('ecole_homepage');
    }
}