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
    private $date_created,$dmd_emplois ,$dmd_cvs,$dmd_formation,$dmd_experience,$users ,$ville_emp,$ville_for,
        $ville_exp ,$emploi_recherche,$logiciel ,$langue ,$certificat ,$diplome ,$universite ,$secteur ,$poste ;
    
    public function __construct()
    {
        $this->date_created = new \DateTime();
        $this->dmd_emplois = new epizy_demandeur_emplois();
        $this->dmd_cvs = new epizy_demandeur_cvs();
        $this->dmd_formation = new epizy_demandeur_formations();
        $this->dmd_experience = new epizy_demandeur_experience();
        $this->users = new epizy_users();
        $this->ville_emp = new epizy_villes();
        $this->ville_for = new epizy_villes();
        $this->ville_exp = new epizy_villes();
        $this->emploi_recherche = new epizy_emploi_recherches();
        $this->logiciel = new epizy_logiciels();
        $this->langue = new epizy_langues();
        $this->certificat = new epizy_certifications();
        $this->diplome = new epizy_diplomes();
        $this->universite = new epizy_universites();
        $this->secteur = new epizy_secteur_activites();
        $this->poste = new epizy_poste_occupes();
    }


    /**
     * @Route("/demandeur/index", name="admin_demandeur_index")
     */
    public function indexAction( Request $request)
    {       

        $form_emplois   = $this->createForm(epizy_demandeur_emploisType::class, $this->dmd_emplois);
        $form_cvs       = $this->createForm(epizy_demandeur_cvsType::class, $this->dmd_cvs);
        $form_formation = $this->createForm(epizy_demandeur_formationsType::class, $this->dmd_formation);
        $form_experience= $this->createForm(epizy_demandeur_experienceType::class, $this->dmd_experience);
        $form_logiciel  = $this->createForm(epizy_logicielsType::class, $this->logiciel);

        $form = $this->createFormBuilder(FormType::class)->setAction('')->setMethod('post')->getForm();

        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $form_emplois->handleRequest($request);
            $form_cvs->handleRequest($request);
            $form_formation->handleRequest($request);
            $form_experience->handleRequest($request);
            $form_logiciel->handleRequest($request);
            //get mail users and demandeurs

            $repo_users = $this->getDoctrine()->getManager()->getRepository('AppBundle:epizy_users');
            $repo_ville = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_villes');
            $repo_dmd   = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_emplois');
            $repo_emp   = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_emploi_recherches');
            $repo_log   = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_logiciels');
            $repo_lang  = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_langues');
//            $repo_diplo = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes');
            $repo_secteur = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes');
            $repo_poste = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_poste_occupes');

            $email_user = $repo_users->findOneBy(['email' => $form_emplois->get('email')->getData()]);
            $email_dmd = $repo_dmd->findOneBy(['email' => $form_emplois->get('email')->getData()]);

            if ($email_user == null || !$email_user && $email_dmd == null || !$email_dmd) {
                $this->users->setName($form_emplois->get('nom')->getData());
                $this->users->setSeoname($form_emplois->get('prenom')->getData());
                $this->users->setEmail($form_emplois->get('email')->getData());
                $this->users->setCreated($this->date_created);
                $this->users->setPassword(sha1($form_emplois->get('nom')->getData()));
                $this->users->setMdpChange('0');
                $this->users->setStatus('0');
                $form_emplois->get('photo')->getData() == null ? $this->users->setHasImage('0') : $this->users->setHasImage('1');
                $em->persist($this->users);
                $em->flush();
                $id_user = $this->users->getId();

                $ville_emploi = $repo_ville->findOneBy(['libele' => $form_emplois->get('ville')->getData()]);

                if ($ville_emploi === null || !$ville_emploi) {
                    $this->ville_emp->setLibele($form_emplois->get('ville')->getData());
                    $this->ville_emp->setEtat('1');
                    $this->ville_emp->setCreated($this->date_created);
                    $em->persist($this->ville_emp);
                    $em->flush();
                    $ville_id = $this->ville_emp->getId();
                }else{
                    $ville_id = $ville_emploi->getId() ;
                }// else get id for select option

                $id_demandeur = null;

                if ($id_user != null && $ville_id != null) {
                    $this->dmd_emplois->setIdUser($id_user);
                    $this->dmd_emplois->setVilleId($ville_id);
                    $this->dmd_emplois->setVille($form_emplois->get('ville')->getData());
                    $em->persist($this->dmd_emplois);
                    $em->persist($form_emplois->getData());
                    $em->flush();
                    $id_demandeur = $this->dmd_emplois->getId();
                }

                if ($id_demandeur != null) {
                    $emploi = $form_cvs->get('emploiRecherche')->getData();
                    $emploi_exist = $repo_emp->findOneBy(['libele' => $emploi]);

                    if ($emploi_exist == null || !$emploi_exist) {
                        $this->emploi_recherche->setLibele($form_cvs->get('emploiRecherche')->getData());
                        $this->emploi_recherche->setEtat('0');
                        $this->emploi_recherche->setCreated($this->date_created);
                        $em->persist($this->emploi_recherche);
                        $em->flush();
                        $emploi_recherche_id = $this->emploi_recherche->getId();
                    }//else get id for select

                    $log = $form_cvs->get('logiciel')->getData();
                    $logiciel_exist = $repo_log->findOneBy(['libele' => $log]);

                    if ($logiciel_exist == null || !$logiciel_exist) {
                        $this->logiciel->setLibele($form_cvs->get('logiciel')->getData());
                        $this->logiciel->setEtat('0');
                        $this->logiciel->setCreated($this->date_created);
                        $em->persist($this->logiciel);
                        $em->flush();
                        $logiciel_id = $this->logiciel->getId();

                    }//else get id for select

                    $langues = $form_cvs->get('langue')->getData();
                    $langue_exist = $repo_lang->findOneBy(['libele' => $langues]);

                    if ($langue_exist == null || !$langue_exist) {
                        $this->langue->setNom($form_cvs->get('langue')->getData());
                        $this->langue->setEtat('0');
                        $this->langue->setCreated($this->date_created);
                        $em->persist($this->langue);
                        $em->flush();
                    }//else get id for select

                    $certificat_id = null;
                    $certificats = $form_cvs->get('centreInteretCertificat')->getData();
                    if (!empty($certificats) || $certificats != null) {
                        $this->certificat->setLibele($form_cvs->get('centreInteretCertificat')->getData());
                        $this->certificat->setEtat('0');
                        $this->certificat->setCreated($this->date_created);
                        $em->persist($this->certificat);
                        $em->flush();
                        $certificat_id = $this->certificat->getId();
                    }

                    $id_cvs = null;
                    if (isset($this->emploi_recherche_id) && !empty($this->emploi_recherche_id)) {
                        $this->dmd_cvs->setEmploirechercheId($this->emploi_recherche_id);
                        $this->dmd_cvs->setLogicielId($logiciel_id);
                        $this->dmd_cvs->setCertificationId($certificat_id);
                        $this->dmd_cvs->setIdDemandeur($id_demandeur);
                        $this->dmd_cvs->setDateCreation($this->date_created);
                        $this->dmd_cvs->setNbrVue('0');
                        $this->dmd_cvs->setReference('CV_' . $id_demandeur);
                        $this->dmd_cvs->setStatu('0');
                        $permis_array = $form_cvs->get('permis')->getData();
                        $permis = implode(',', $permis_array);
                        $this->dmd_cvs->setPermis($permis);
                        $em->persist($this->dmd_cvs);
                        $em->persist($form_cvs->getData());
                        $em->flush();
                        $id_cvs = $this->dmd_cvs->getId();
                    }

                    // formation et experience

                    if ($id_cvs != null) {
                        $ville_formation = $repo_ville->findOneBy(['libele' => $form_formation->get('ville')->getData()]);
                        if ($ville_formation === null || !$ville_formation) {
                            $this->ville_for->setLibele($form_formation->get('ville')->getData());
                            $this->ville_for->setEtat('1');
                            $this->ville_for->setCreated($this->date_created);
                            $em->persist($this->ville_for);
                            $em->flush();
                            $id_ville = $this->ville_for->getId();
                        }else{
                            $id_ville = $ville_formation->getId() ;
                        } // else get id for select option

                        // $diplome_exist = $repo_diplo->findOneBy(['libele'=>$form_formation->get('diplome')->getData()]) ;
                        // if ( $diplome_exist === null || !$diplome_exist){
                        $this->diplome->setLibele($form_formation->get('diplome')->getData());
                        $this->diplome->setEtat('1');
                        $this->diplome->setCreated($this->date_created);
                        $em->persist($this->diplome);
                        //} // else get id for select option

                        $this->universite->setLibele($form_formation->get('universite')->getData());
                        $this->universite->setEtat('0');
                        $this->universite->setCreated($this->date_created);
                        $em->persist($this->universite);
                        $em->flush();

                        /*/*********************/

                        $id_diplome = $this->diplome->getId();
                        $id_universite = $this->universite->getId();

                        $this->dmd_formation->setIdDemandeur($id_demandeur);
                        $this->dmd_formation->setIdCvs($id_cvs);
                        $this->dmd_formation->setVilleId($id_ville);
                        $this->dmd_formation->setDiplomeId($id_diplome);
                        $this->dmd_formation->setUniversiteId($id_universite);
                        $this->dmd_formation->setVille($form_formation->get('ville')->getData());
                        $this->dmd_formation->setAnnee($form_formation->get('annee')->getData());
                        $this->dmd_formation->setUniversite($form_formation->get('universite')->getData());
                        $em->persist($this->dmd_formation);
                        $em->persist($form_formation->getData());
                        $em->flush();

//                        // demandeur experience
//
                        $ville_experience = $repo_ville->findOneBy(['libele' => $form_experience->get('ville')->getData()]);
                        if ($ville_experience === null || !$ville_experience) {
                            $this->ville_exp->setLibele($form_experience->get('ville')->getData());
                            $this->ville_exp->setEtat('1');
                            $this->ville_exp->setCreated($this->date_created);
                            $em->persist($this->ville_exp);
                            $em->flush();
                            $id_vil = $this->ville_exp->getId();
                        }else{
                            $id_vil = $ville_experience->getId() ;
                        } // else get id for select option

                        $secteur_exist = $repo_secteur->findOneBy(['libele' => $form_experience->get('secteurActivite')->getData()]);
                        if ($secteur_exist === null || !$secteur_exist) {
                            $this->secteur->setLibele($form_experience->get('secteurActivite')->getData());
                            $this->secteur->setEtat('1');
                            $this->secteur->setCreated($this->date_created);
                            $em->persist($this->secteur);
                            $em->flush();
                            $id_secteur = $this->secteur->getId();
                        } // else get id for select option

                        $poste_exist = $repo_poste->findOneBy(['libele' => $form_experience->get('posteOccupe')->getData()]);
                        if ($poste_exist === null || !$poste_exist) {
                            $this->poste->setLibele($form_experience->get('posteOccupe')->getData());
                            $this->poste->setEtat('1');
                            $this->poste->setCreated($this->date_created);
                            $em->persist($this->poste);
                            $em->flush();
                            $post_id = $this->poste->getId();
                        } // else get id for select option

                        $this->dmd_experience->setIdDemandeur($id_demandeur);
                        $this->dmd_experience->setIdCvs($id_cvs);
                        $this->dmd_experience->setVilleId($id_vil);
                        $this->dmd_experience->setPosteoccupeId($post_id);
                        $this->dmd_experience->setSecteuractiviteId($id_secteur);
                        $this->dmd_experience->setVille($form_experience->get('ville')->getData());
                        $em->persist($this->dmd_experience);
                        $em->persist($form_experience->getData());
                        $em->flush();
                    }

                }

            } else {
                return new Response('Votre email est déjà utilisé, veuillez le changer pour pouvoir insérer un nouveau CV.');
            }
        }else{

            return $this->render('AdminBundle:Demandeur:index.html.twig',
                array(
                    'form_emplois' => $form_emplois->createView(),
                    'form_cvs' => $form_cvs->createView(),
                    'form_formation' => $form_formation->createView(),
                    'form_experience' => $form_experience->createView(),
                    'form_logiciel' => $form_logiciel->createView(),
                    'form' => $form->createView()
                )
            );
        }

        return $this->view('index.html.twig',
            array(
                'form_emplois' => $form_emplois->createView(),
                'form_cvs' => $form_cvs->createView(),
                'form_formation' => $form_formation->createView(),
                'form_experience' => $form_experience->createView(),
                'form_logiciel' => $form_logiciel->createView(),
                'form' => $form->createView()
            )
        );
    }


    /**
     * @Route("/demandeur/show", name="admin_demandeur_show")
     */
    public function showCVAction(){
        $demandeur_cv = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs') ;
        $demandeur_emplois = $this->getRepositoryClass('AdminBundle:epizy_demandeur_emplois') ;
        $all_cv = $demandeur_cv->findAll() ;
        return $this->view('show.html.twig', array('all_cv'=>$all_cv ) );
    }

    private function getRepositoryClass( $class ){
        $repository = $this->getDoctrine()->getManager()->getRepository($class);
        return $repository ;
    }

    public function view( $field , $data=array()){
        return $this->render('AdminBundle:Demandeur:'.$field, $data) ;
    }

}