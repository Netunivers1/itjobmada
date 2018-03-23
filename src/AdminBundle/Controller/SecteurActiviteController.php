<?php
/**
 * Created by PhpStorm.
 * User: Nambinina
 * Date: 23/03/2018
 * Time: 09:13
 */

namespace AdminBundle\Controller;
use AdminBundle\Entity\epizy_secteur_activites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecteurActiviteController extends Controller
{

 	/**
     *
     * @Route("/entreprise/secteur", name="admin_entreprise_secteur_index")
     */
    public function listeSecteurAction(Request $request){
    	$secteur = new epizy_secteur_activites();
        $em =  $this->getDoctrine()->getManager();
        $listeSecteur = $em->getRepository('AdminBundle:epizy_secteur_activites')->findAll();
        $secteurs  = $this->get('knp_paginator')->paginate($listeSecteur,$request->query->get('page', 1),10);

        $form = $this->createFormBuilder($secteur)
        	 ->add('libele', TextType::class,array(
        	  'attr' =>array(
        	  	'class'=>'form-control',
        	   'placeholder'=> 'Nom du secteur d\'activité' ,),
        	  'label' => false
                ))
        	 ->add('save', SubmitType::class, array(
                'label'=> 'AJOUTER', 
                'attr' => [
                    'class' => 'btn btn-success btn-lg btn-block'
                    ]  ))
        	  ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $secteur = $form->getData();
            $secteur->setEtat(0);
            $em->persist($secteur);
            $em->flush($secteur);

            $this-> addFlash('message','Le secteur d\'activité a bien été ajouté.');
            return $this->redirectToRoute('admin_entreprise_secteur_index');
        }

        return  $this->render('AdminBundle:OffreEmploi:liste_secteur.html.twig', array('listSecteur'=>$secteurs,
        	'form'=>$form->createView() ));
    }
  

  	/**
     *
     * @Route("/entreprise/secteur", name="admin_entreprise_secteur_create")
     */
    public function createSecteurAction(){
        $em =  $this->getDoctrine()->getManager();
        $form = $this->createForm(epizy_secteur_activitesType::class);

        if ($form->isSubmitted() && $form->isValid())
        {
            $secteur = $form->getData();
            $em->persist($secteur);
            $em->flush();

            return $this->redirectToRoute('admin_entreprise_secteur_index');
        }

        return  $this->render('AdminBundle:OffreEmploi:liste_secteur.html.twig', array('form'=>$form->createView()));
    }

     /**
     * @Route("/entreprise/secteur/changestatus/{id}", name="admin_secteur_change_status")
     */
    public function ChangeStatus($id){
        $em = $this->getDoctrine()->getManager();
        $user_modifier = $em->getRepository('AdminBundle:epizy_secteur_activites')->find($id);
        $user_modifier->setEtat($user_modifier->getEtat() == 0 ? 1 : 0);
        $em->flush($user_modifier);
        return $this->redirectToRoute('admin_entreprise_secteur_index');

    }


     /**
     * @Route("/entreprise/delete_secteur/{id}", name="admin_secteur_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $secteur_a_sup = $em->getRepository('AdminBundle:epizy_secteur_activites')->find($id);
        $em->remove($secteur_a_sup);
        $em->flush();
        
        $this->addFlash('message', 'Secteur supprimé');
       
        return $this->redirectToRoute('admin_entreprise_secteur_create');
        
        
    }
}
