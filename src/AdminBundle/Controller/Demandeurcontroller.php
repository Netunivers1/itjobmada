<?php

namespace AdminBundle\Controller;
use AdminBundle\Entity\epizy_certifications;
use AdminBundle\Entity\epizy_demandeur_cvs;
use AdminBundle\Entity\epizy_demandeur_emplois;
use AdminBundle\Entity\epizy_demandeur_experience;
use AdminBundle\Entity\epizy_demandeur_formations;
use AdminBundle\Entity\epizy_diplomes;
use AdminBundle\Entity\epizy_emploi_recherches;
use AdminBundle\Entity\epizy_langues;
use AdminBundle\Entity\epizy_logiciels;
use AdminBundle\Entity\epizy_poste_occupes;
use AdminBundle\Entity\epizy_secteur_activites;
use AdminBundle\Entity\epizy_universites;
use AdminBundle\Entity\epizy_villes;
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
        $date_created   = new \DateTime() ;
        $dmd_emplois    = new epizy_demandeur_emplois() ;
        $dmd_cvs        = new epizy_demandeur_cvs() ;
        $dmd_formation  = new epizy_demandeur_formations() ;
        $dmd_experience = new epizy_demandeur_experience() ;
        $users          = new epizy_users();
        $ville          = new epizy_villes() ;
        $emploi_recherche= new epizy_emploi_recherches() ;
        $logiciel       = new epizy_logiciels();
        $langue         = new epizy_langues();
        $certificat     = new epizy_certifications();
        $diplome        = new epizy_diplomes();
        $universite     = new epizy_universites();
        $secteur        = new epizy_secteur_activites();
        $poste          = new epizy_poste_occupes();

        $form_emplois   = $this->createForm( epizy_demandeur_emploisType::class, $dmd_emplois) ;
        $form_cvs       = $this->createForm( epizy_demandeur_cvsType::class, $dmd_cvs) ;
        $form_formation = $this->createForm( epizy_demandeur_formationsType::class, $dmd_formation) ;
        $form_experience= $this->createForm( epizy_demandeur_experienceType::class, $dmd_experience) ;
        $form_logiciel  = $this->createForm( epizy_logicielsType::class, $logiciel) ;

        $form = $this->createFormBuilder(FormType::class)->setAction('')->setMethod('post')->getForm();

        $form->handleRequest($request) ;
        $em = $this->getDoctrine()->getManager();

        if ( $form->isValid() ){
            $form_emplois->handleRequest($request);
            $form_cvs->handleRequest($request);
            $form_formation->handleRequest($request);
            $form_experience->handleRequest($request);
            $form_logiciel->handleRequest($request);
            //get mail users and demandeurs

            $repo_users  = $this->getDoctrine()->getManager()->getRepository('AppBundle:epizy_users') ;
            $repo_ville  = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_villes') ;
            $repo_dmd    = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_emplois') ;
            $repo_emp    = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_emploi_recherches') ;
            $repo_log    = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_logiciels') ;
            $repo_lang   = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_langues') ;
            $repo_diplo  = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes') ;
            $repo_secteur= $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes') ;
            $repo_poste  = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_poste_occupes') ;

            //$email_user  = $repo_users->findOneBy(['email'=>$form_emplois->get('email')->getData()]) ;
            //$email_dmd   = $repo_dmd->findOneBy(['email'=>$form_emplois->get('email')->getData()]) ;

            $email_user = null ;
            $email_dmd = null ;
            if ($email_user  == null && $email_dmd == null ){
                $users->setName($form_emplois->get('nom')->getData());
                $users->setSeoname($form_emplois->get('prenom')->getData());
                $users->setEmail($form_emplois->get('email')->getData());
                $users->setCreated($date_created) ;
                $users->setPassword(  sha1($form_emplois->get('nom')->getData() ) ) ;
                $users->setMdpChange('0') ;
                $users->setStatus('0') ;
                $form_emplois->get('photo')->getData() == null ? $users->setHasImage('0'):$users->setHasImage('1');
                $em->persist($users);

                $ville_exist = $repo_ville->findOneBy(['libele'=>$form_emplois->get('ville')->getData()]) ;
                if ( $ville_exist === null ){
                    $ville->setLibele( $form_emplois->get('ville')->getData());
                    $ville->setEtat( '1');
                    $ville->setCreated( $date_created );
                    $em->persist($ville);

                } // else get id for select option

                $em->flush();
                $id_user = $users->getId() ;
                $ville_id = $ville->getId() ;
                $id_demandeur = null ;

                if ( $id_user !== null && $ville_id !== null){
                    $dmd_emplois->setIdUser( $id_user);
                    $dmd_emplois->setVilleId( $ville_id);
                    $dmd_emplois->setVille( $form_emplois->get('ville')->getData());
                    $em->persist( $dmd_emplois ) ;
                    $em->persist( $form_emplois->getData()) ;
                    $em->flush() ;
                    $id_demandeur = $dmd_emplois->getId() ;
                }

                if ($id_demandeur != null) {

                    $emploi             = $form_cvs->get('emploiRecherche')->getData();
                    $emploi_exist       = $repo_emp->findOneBy(['libele'=>$emploi]);

                    if ( $emploi_exist == null ) {
                        $emploi_recherche->setLibele( $form_cvs->get('emploiRecherche')->getData() );
                        $emploi_recherche->setEtat('0');
                        $emploi_recherche->setCreated( $date_created );
                        $em->persist($emploi_recherche) ;
                    }//else get id for select

                    $log            = $form_cvs->get('logiciel')->getData();
                    $logiciel_exist = $repo_log->findOneBy(['libele'=>$log]);

                    if ( $logiciel_exist == null ) {
                        $logiciel->setLibele( $form_cvs->get('logiciel')->getData() );
                        $logiciel->setEtat('0');
                        $logiciel->setCreated( $date_created );
                        $em->persist($logiciel) ;
                    }//else get id for select

                    $langues         = $form_cvs->get('langue')->getData();
                    $langue_exist    = $repo_lang->findOneBy(['libele'=>$langues]);

                    if ( $langue_exist == null ) {
                        $langue->setNom( $form_cvs->get('langue')->getData() );
                        $langue->setEtat('0');
                        $langue->setCreated( $date_created );
                        $em->persist($langue) ;
                    }//else get id for select

                    $certificat_id = null ;
                    $certificats = $form_cvs->get('centreInteretCertificat')->getData();
                    if ( !empty($certificats) || $certificats != null ) {
                        $certificat->setLibele( $form_cvs->get('centreInteretCertificat')->getData() );
                        $certificat->setEtat('0');
                        $certificat->setCreated( $date_created );
                        $em->persist($certificat) ;
                        $em->flush() ;
                        $certificat_id       = $certificat->getId() ;
                    }
                    $em->flush() ;
                    $emploi_recherche_id = $emploi_recherche->getId() ;
                    $logiciel_id         = $logiciel->getId() ;

                    $id_cvs = null ;
                    if ( isset($emploi_recherche_id) && $emploi_recherche_id !=''){
                        $dmd_cvs->setEmploirechercheId( $emploi_recherche_id );
                        $dmd_cvs->setLogicielId( $logiciel_id );
                        $dmd_cvs->setCertificationId( $certificat_id );
                        $dmd_cvs->setIdDemandeur( $id_demandeur );
                        $dmd_cvs->setDateCreation( $date_created );
                        $dmd_cvs->setNbrVue( '0' );
                        $dmd_cvs->setReference('CV_'.$id_demandeur );
                        $dmd_cvs->setStatu( '0' );
                        $permis_array =  $form_cvs->get('permis')->getData();
                        $permis = implode(',' , $permis_array) ;
                        $dmd_cvs->setPermis($permis) ;
                        $em->persist( $dmd_cvs) ;
                        $em->persist( $form_cvs->getData()) ;
                        $em->flush() ;
                        $id_cvs = $dmd_cvs->getId();
                    }

                    // formation et experience

                    if ( $id_cvs != null ){
                        $ville_existe = $repo_ville->findOneBy(['libele'=>$form_formation->get('ville')->getData()]) ;
                        if ( $ville_existe === null ){
                            $ville->setLibele( $form_formation->get('ville')->getData());
                            $ville->setEtat('1');
                            $ville->setCreated( $date_created );
                            $em->persist($ville);
                        } // else get id for select option

                        $diplome_exist = $repo_diplo->findOneBy(['libele'=>$form_formation->get('diplome')->getData()]) ;
                        if ( $diplome_exist === null ){
                            $diplome->setLibele( $form_formation->get('diplome')->getData());
                            $diplome->setEtat( '1');
                            $diplome->setCreated( $date_created );
                            $em->persist($diplome);
                        } // else get id for select option

                        $universite->setLibele( $form_formation->get('universite')->getData() ) ;
                        $universite->setEtat('0') ;
                        $universite->setCreated( $date_created ) ;
                        $em->persist($universite) ;
                        $em->flush() ;

                        /*/*********************/

                        $id_ville       = $ville->getId();
                        $id_diplome     = $diplome->getId();
                        $id_universite  = $universite->getId();

                        $dmd_formation->setIdDemandeur($id_demandeur) ;
                        $dmd_formation->setIdCvs($id_cvs) ;
                        $dmd_formation->setVilleId($id_ville) ;
                        $dmd_formation->setDiplomeId($id_diplome) ;
                        $dmd_formation->setUniversiteId($id_universite) ;
                        $dmd_formation->setVille($form_formation->get('ville')->getData()) ;
                        $dmd_formation->setAnnee($form_formation->get('annee')->getData()) ;
                        $dmd_formation->setUniversite($form_formation->get('universite')->getData()) ;
                        $em->persist($form_formation->getData());
                        $em->persist($dmd_formation);
                        $em->flush() ;

                        // demandeur experience

                        $ville_secteur = $repo_ville->findOneBy(['libele'=>$form_experience->get('ville')->getData()]) ;
                        if ( $ville_secteur === null ){
                            $ville->setLibele( $form_experience->get('ville')->getData());
                            $ville->setEtat('1');
                            $ville->setCreated( $date_created );
                            $em->persist($ville);
                        } // else get id for select option

                        $secteur_exist = $repo_secteur->findOneBy(['libele'=>$form_experience->get('secteurActivite')->getData()]) ;
                        if ( $secteur_exist === null ){
                            $secteur->setLibele( $form_experience->get('secteurActivite')->getData());
                            $secteur->setEtat('1');
                            $secteur->setCreated( $date_created );
                            $em->persist($secteur);
                        } // else get id for select option

                        $poste_exist = $repo_poste->findOneBy(['libele'=>$form_experience->get('posteOccupe')->getData()]) ;
                        if ( $poste_exist === null ){
                            $poste->setLibele( $form_experience->get('posteOccupe')->getData());
                            $poste->setEtat('1');
                            $poste->setCreated( $date_created );
                            $em->persist($poste);
                        } // else get id for select option

                        $em->flush() ;

                        $id_vil     = $ville->getId();
                        $id_secteur = $secteur->getId();
                        $post_id    = $poste->getId();



                        $dmd_experience->setIdDemandeur( $id_demandeur) ;
                        $dmd_experience->setIdCvs( $id_cvs) ;
                        $dmd_experience->setVilleId( $id_vil) ;
                        $dmd_experience->setPosteoccupeId( $post_id ) ;
                        $dmd_experience->setSecteuractiviteId( $id_secteur) ;
                        $em->persist($dmd_experience);
                        $em->persist( $form_experience->getData());
                        $em->flush() ;
                    }

                }

            }else{
                return new Response( 'Votre email est déjà utilisé, veuillez le changer pour pouvoir insérer un nouveau CV.');
           }
                return new Response('inserer') ;
        }

        return $this->render('AdminBundle:Demandeur:index.html.twig',
            array(
                'form_emplois'=>$form_emplois->createView(),
                'form_cvs'=>$form_cvs->createView(),
                'form_formation'=>$form_formation->createView(),
                'form_experience'=>$form_experience->createView(),
                'form_logiciel'=>$form_logiciel->createView(),
                'form'=>$form->createView()
            )
        ) ;
    }

}