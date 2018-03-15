<?php

namespace AdminBundle\Controller;
use AdminBundle\Entity\epizy_demandeur_cvs;
use AdminBundle\Entity\epizy_demandeur_emplois;
use AdminBundle\Entity\epizy_demandeur_experience;
use AdminBundle\Entity\epizy_demandeur_formations;
use AdminBundle\Entity\epizy_logiciels;
use AdminBundle\Form\epizy_demandeur_cvsType;
use AdminBundle\Form\epizy_demandeur_emploisType;
use AdminBundle\Form\epizy_demandeur_experienceType;
use AdminBundle\Form\epizy_demandeur_formationsType;
use AdminBundle\Form\epizy_logicielsType;
use AppBundle\Entity\epizy_users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Demandeurcontroller extends Controller
{
    /**
     * @Route("/demandeur/index", name="admin_demandeur_index")
     */
    public function indexAction( Request $request){
        $dmd_emplois    = new epizy_demandeur_emplois() ;
        $dmd_cvs        = new epizy_demandeur_cvs() ;
        $dmd_formation  = new epizy_demandeur_formations() ;
        $dmd_experience = new epizy_demandeur_experience() ;
        $logiciels      = new epizy_logiciels() ;
        $users          = new epizy_users();
        $form_emplois = $this->createForm( epizy_demandeur_emploisType::class, $dmd_emplois) ;
        $form_cvs     = $this->createForm( epizy_demandeur_cvsType::class, $dmd_cvs) ;
        $form_formation     = $this->createForm( epizy_demandeur_formationsType::class, $dmd_formation) ;
        $form_experience    = $this->createForm( epizy_demandeur_experienceType::class, $dmd_experience) ;
        $form_logiciel      = $this->createForm( epizy_logicielsType::class, $logiciels) ;
        //configuration action et method
        $form = $this->createFormBuilder(FormType::class)
            ->setAction('')
            ->setMethod('post')
            ->getForm();

        $form->handleRequest($request) ;
        $em = $this->getDoctrine()->getManager();

        if ( $form->isValid() ){
            //get mail users and demandeurs
            $repo_users = $this->getDoctrine()->getManager()->getRepository('AppBundle:epizy_users') ;
            $email_exist = $repo_users->findOneBy(['email'=>$form_emplois->get('email')->getData()]) ;

            if ($email_exist === null){
                $form_emplois->handleRequest($request);
                $users->setName($form_emplois->get('nom')->getData());
                $users->setSeoname($form_emplois->get('prenom')->getData());
                $users->setEmail($form_emplois->get('email')->getData());
                $users->setCreated( new \DateTime()) ;
                $users->setPassword( $form_emplois->get('nom')->getData()) ;
                $users->setMdpChange('0') ;
                $users->setStatus('0') ;
                $form_emplois->get('photo')->getData() == null ? $users->setHasImage('0'):$users->setHasImage('1');
                $em->persist($users);
                $em->flush();

                return new Response('ko') ;
            }




//            $dmd_emplois->setIdUser('2');
//            $dmd_emplois->setVilleId('2');
//            $dmd_emplois->setPhoto('sary.jpg');
//            $form_emplois->handleRequest($request) ;
//
//                $var = $form_emplois->getData();
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($var);
//                $em->flush();
                return new Response('ok') ;
        }
            $er = (string)$form->getErrors(true) ;
        return $this->render('AdminBundle:Demandeur:index.html.twig',
            array(
                'form_emplois'=>$form_emplois->createView(),
                'form_cvs'=>$form_cvs->createView(),
                'form_formation'=>$form_formation->createView(),
                'form_experience'=>$form_experience->createView(),
                'form_logiciel'=>$form_logiciel->createView(),
                'form'=>$form->createView(),
                'error'=>$er
            )
        ) ;
    }

}