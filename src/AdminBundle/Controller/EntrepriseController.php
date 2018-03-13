<?php
/**
 * Created by PhpStorm.
 * User: Nambinina
 * Date: 13/03/2018
 * Time: 09:53
 */

namespace AdminBundle\Controller;


use AdminBundle\Entity\epizy_entreprises;
use AdminBundle\Entity\epizy_secteur_activites;
use AdminBundle\Entity\epizy_roles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class EntrepriseController extends Controller
{

    public function indexAction(){
        $entreprise = new epizy_entreprises();
        $em = $this->getDoctrine()->getManager();
        $listEntreprise= $em->getRepository('AdminBundle:epizy_entreprises')->findAll();

        return $this->render('AdminBundle:OffreEmploi:liste_entreprise.html.twig', array('listEntreprise'=>$listEntreprise));
    }

    public function createAction(Request $request){
        $entreprise = new epizy_entreprises();
        $entreprise->setNotificationCvPoste('Oui');
        $entreprise->setEmailResponsable('user@shasama.com');
        $entreprise->setIdRole('11');
        $entreprise->setIdUser('3');

        $form = $this->createFormBuilder($entreprise)
            ->add('nom_entreprise', TextType::class,array('label' => 'Nom de l\'entreprise'))
            ->add('adresse_physique', TextType::class,array('label' => 'Adresse physique de l\'entreprise'))
            ->add('nif',TextType::class, array('label'=>'Nif'))
            ->add('statistique', TextType::class,array('label' => 'Numéro statistique'))
            ->add('tel_fixe_entreprise', TextType::class,array('label' => 'Téléphone fixe de l\'entreprie'))
            ->add('titre',TextType::class,array('label' => 'Titre') )
            ->add('nom_responsable', TextType::class,array('label' => 'Nom du responsable'))
            ->add('prenom_responsable', TextType::class, array('label'=> 'Prénom duresponsable'))
            ->add('tel_mobil_responsable',TextType::class,array( 'label'=>'Téléphone mobile du responsable'))
            ->add('secteur_activite', TextType::class, array('label'=>'secteur d\'activité'))
           #   ->add('emaill_responsable', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Sauvegarder'))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entreprise = $form->getData();
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entreprise);
            $em->flush($entreprise);

            return $this->redirectToRoute('admin_entreprise_index');
        }

      return  $this->render('AdminBundle:OffreEmploi:create_entreprise.html.twig',array(
            'form' => $form->createView(),
        ));
    }


    public function listeSecteurAction(){
        $em =  $this->getDoctrine()->getManager();

        $listSecteur = $em->getRepository('AdminBundle:epizy_secteur_activites')->findAll();

      return  $this->render('AdminBundle:OffreEmploi:liste_secteur.html.twig', array('listSecteur'=>$listSecteur));
    }
}