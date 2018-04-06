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
use AdminBundle\ImageUpload;
use AppBundle\Entity\epizy_users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeurController extends Controller
{
    private $date_created, $dmd_emplois, $dmd_cvs, $dmd_formation, $dmd_experience, $users, $ville_emp, $ville_for,
        $ville_exp, $emploi_recherche, $logiciel, $langue, $certificat, $diplome, $universite, $secteur, $poste, $file;

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
    public function indexAction(Request $request)
    {
        $form_emplois = $this->createForm(epizy_demandeur_emploisType::class, $this->dmd_emplois);
        $form_cvs = $this->createForm(epizy_demandeur_cvsType::class, $this->dmd_cvs);
        $form_formation = $this->createForm(epizy_demandeur_formationsType::class, $this->dmd_formation);
        $form_experience = $this->createForm(epizy_demandeur_experienceType::class, $this->dmd_experience);
        $form_logiciel = $this->createForm(epizy_logicielsType::class, $this->logiciel);

        $form = $this->createFormBuilder(FormType::class)->setAction('')->setMethod('post')->getForm();
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        $errors = null ;

        if ($form->isValid()) {
            $form_emplois->handleRequest($request);
            $form_cvs->handleRequest($request);
            $form_formation->handleRequest($request);
            $form_experience->handleRequest($request);
            $form_logiciel->handleRequest($request);
            //get mail users and demandeurs

            $repo_users = $this->getDoctrine()->getManager()->getRepository('AppBundle:epizy_users');
            $repo_ville = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_villes');
            $repo_dmd = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_emplois');
            $repo_emp = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_emploi_recherches');
            $repo_log = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_logiciels');
            $repo_lang = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_langues');
            $repo_diplo = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes');
            $repo_certificat = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_certifications');
            $repo_secteur = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_secteur_activites');
            $repo_poste = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_poste_occupes');
            $repo_universite = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_universites');
            $repo_form = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_formations');

            $email_user = $repo_users->findOneBy(['email' => $form_emplois->get('email')->getData()]);
            $email_dmd = $repo_dmd->findOneBy(['email' => $form_emplois->get('email')->getData()]);
//            $email_user = null;
//            $email_dmd = null;
            if ($email_user == null || !$email_user && $email_dmd == null || !$email_dmd) {

                /* insert user not existe*/
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
                $id_user = $this->users;

                /* get and insert ville demandeur emploi*/
                $ville_emploi = $repo_ville->findOneBy(['libele' => $form_emplois->get('ville')->getData()]);

                if ($ville_emploi === null || !$ville_emploi) {
                    $this->ville_emp->setLibele($form_emplois->get('ville')->getData());
                    $this->ville_emp->setEtat('1');
                    $this->ville_emp->setCreated($this->date_created);
                    $em->persist($this->ville_emp);
                    $em->flush();
                    $ville_id = $this->ville_emp;
                    $ville_emp = $ville_id->getLibele();
                } else {
                    $ville_id = $ville_emploi;
                    $ville_emp = $ville_id->getLibele();
                }

                $new_choixEmploi = $form_emplois->get('new_choixEmploi')->getData();


                if ($new_choixEmploi != '' && isset($new_choixEmploi)) {
                    $choixExist = $repo_emp->findOneBy(['libele' => $new_choixEmploi]);
                    if ($choixExist == null || !$choixExist) {
                        $this->dmd_emplois->setChoixEmploi($new_choixEmploi);
                    } else {
                        $choixEmploi_existe = $choixExist->getLibele();
                        $this->dmd_emplois->setChoixEmploi($choixEmploi_existe);
                    }
                } else {
                    $choixEmploi = $form_emplois->get('choixEmploi')->getData();
                    if ( $choixEmploi == null){
                        $this->dmd_emplois->setChoixEmploi('Toutes les offres d\'emploi');
                    }else{
                        $this->dmd_emplois->setChoixEmploi($choixEmploi->getLibele());
                    }
                }

                $new_choixFormation = $form_emplois->get('new_choixFormation')->getData();
                $choixFormation = $form_emplois->get('choixFormation')->getData();

                if ($new_choixFormation != '' && isset($new_choixFormation)) {
                    $choixExist = $repo_dmd->findOneBy(['choixFormation' => $new_choixFormation]);
                    if ($choixExist == null || !$choixExist) {
                        $this->dmd_emplois->setChoixFormation($new_choixFormation);
                    } else {
                        $this->dmd_emplois->setChoixFormation($choixExist->getChoixFormation());
                    }
                } else {
                    if ( $choixFormation == null){
                        $this->dmd_emplois->setChoixFormation('Toutes les formations');
                    }else{
                        $this->dmd_emplois->setChoixFormation($choixFormation->getChoixFormation());
                    }
                }

                /* insert image*/
                $photo = $form_emplois->get('photo')->getData();
                if ($photo != '' && isset($photo)) {
                    $fileNames = $this->upload($photo) ;
                    if ( $fileNames !== false) {
                        $this->dmd_emplois->setPhoto($fileNames);
                    }else{
                        return new Response('Votre photo n\'est pas jpeg/jpg') ;
                    }
                }

                $id_demandeur = null;
                if ($id_user != null && $ville_id != null) {
                    $this->dmd_emplois->setIdUser($id_user);
                    $this->dmd_emplois->setVilleId($ville_id);
                    $this->dmd_emplois->setVille($ville_emp);
                    $em->persist($this->dmd_emplois);
                    $em->persist($form_emplois->getData());
                    $em->flush();
                    $id_demandeur = $this->dmd_emplois;
                }

                if ($id_demandeur != null) {

                    $emploi = $form_cvs->get('emploiRecherche')->getData();

                    if ($emploi != '' && isset($emploi)){
                        $emploi_exist = $repo_emp->findOneBy(['libele' => $emploi]);
                        if ($emploi_exist == null || !$emploi_exist) {
                            $this->emploi_recherche->setLibele($form_cvs->get('emploiRecherche')->getData());
                            $this->emploi_recherche->setEtat('1');
                            $this->emploi_recherche->setCreated($this->date_created);
                            $em->persist($this->emploi_recherche);
                            $em->flush();
                            $emploi_recherche_id = $this->emploi_recherche;
                            $emploi_recherche = $emploi_recherche_id->getLibele();
                        } else {
                            $emploi_recherche_id = $emploi_exist;
                            $emploi_recherche = $emploi_recherche_id->getLibele();
                        }
                    }else{
                        $emploi_rech = $form_cvs->get('emploiRechercheId')->getData();
                        $emploi_recherche_id = $emploi_rech ;
                        $emploi_recherche = $emploi_recherche_id->getLibele();
                    }

                    $logId = $form_cvs->get('logicielId')->getData();
                    $log = $form_cvs->get('logiciel')->getData();

                    if ( $log != '' && isset($log) ){
                        $logiciel_exist = $repo_log->findOneBy(['libele' => $log]);
                        if ($logiciel_exist == null || !$logiciel_exist) {
                            $this->logiciel->setLibele($form_cvs->get('logiciel')->getData());
                            $this->logiciel->setEtat('0');
                            $this->logiciel->setCreated($this->date_created);
                            $em->persist($this->logiciel);
                            $em->flush();
                            $logiciel_id = $this->logiciel;
                            $logiciel = $logiciel_id->getLibele();
                        } else {
                            $logiciel_id = $logiciel_exist;
                            $logiciel = $logiciel_id->getLibele();
                        }
                    }else{
                        $logiciel_id = $logId;
                        $logiciel = $logiciel_id->getLibele();
                    }

                    $langueId = $form_cvs->get('langueId')->getData();
                    $langues = $form_cvs->get('langue')->getData();
                    $langue_exist = $repo_lang->findOneBy(['nom' => $langues]);

                    if ( $langues != '' && isset($langues)){
                        if ($langue_exist == null || !$langue_exist) {
                            $this->langue->setNom($form_cvs->get('langue')->getData());
                            $this->langue->setEtat('0');
                            $this->langue->setCreated($this->date_created);
                            $em->persist($this->langue);
                            $em->flush();
                            $langue_id = $this->langue;
                            $langue = $langue_id->getNom();
                        } else {
                            $langue_id = $langue_exist;
                            $langue = $langue_id->getNom();
                        }
                    }else{
                        $langue_id = $langueId;
                        $langue = $langue_id->getNom();
                    }

                    $certificat_id = null;
                    $certificats = $form_cvs->get('centreInteretCertificat')->getData();
                    if (isset($certificats) || !empty($certificats)) {
                        $certificat_exist = $repo_certificat->findOneBy(['libele' => $certificats]);
                        if (!$certificat_exist || $certificat_exist == null) {
                            $this->certificat->setLibele($certificats);
                            $this->certificat->setEtat('0');
                            $this->certificat->setCreated($this->date_created);
                            $em->persist($this->certificat);
                            $em->flush();
                            $certificat_id = $this->certificat;
                        } else {
                            $certificat_id = $certificat_exist;
                        }
                    }

                    $id_cvs = null;
                    if (isset($emploi_recherche_id) && !empty($emploi_recherche_id)) {

                        $this->dmd_cvs->setEmploirechercheId($emploi_recherche_id);
                        $this->dmd_cvs->setEmploirecherche($emploi_recherche);
                        $this->dmd_cvs->setLogicielId($logiciel_id);
                        $this->dmd_cvs->setLogiciel($logiciel);
                        $this->dmd_cvs->setCertificationId($certificat_id);
                        $this->dmd_cvs->setIdDemandeur($id_demandeur);
                        $this->dmd_cvs->setLangueId($langue_id);
                        $this->dmd_cvs->setLangue($langue);
                        $this->dmd_cvs->setDateCreation($this->date_created);
                        $this->dmd_cvs->setNbrVue('0');
                        $this->dmd_cvs->setReference('CV_' . $id_demandeur->getId());
                        $this->dmd_cvs->setStatu('1');
                        $permis_array = $form_cvs->get('permis')->getData();
                        $permis = implode(',', $permis_array);
                        $this->dmd_cvs->setPermis($permis);
                        $em->persist($this->dmd_cvs);
                        $em->persist($form_cvs->getData());
                        $em->flush();
                        $id_cvs = $this->dmd_cvs;
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
                            $ville_for = $this->ville_for->getLibele();
                        } else {
                            $id_ville = $ville_formation->getId();
                            $ville_for = $ville_formation->getLibele();
                        }

                        $diplome_exist = $repo_diplo->findOneBy(['libele' => $form_formation->get('diplomes')->getData()]);
                        if ($diplome_exist === null || !$diplome_exist) {
                            $this->diplome->setLibele($form_formation->get('diplomes')->getData());
                            $this->diplome->setEtat('1');
                            $this->diplome->setCreated($this->date_created);
                            $em->persist($this->diplome);
                            $em->flush();
                            $id_diplome = $this->diplome;
                            $diplomes = $id_diplome->getLibele();
                        } else {
                            $id_diplome = $diplome_exist;
                            $diplomes = $id_diplome->getLibele();
                        }

                        $universite_existe = $repo_universite->findOneBy(['libele' => $form_formation->get('universites')->getData()]);
                        if ($universite_existe == null || !$universite_existe) {
                            $this->universite->setLibele($form_formation->get('universites')->getData());
                            $this->universite->setEtat('1');
                            $this->universite->setCreated($this->date_created);
                            $em->persist($this->universite);
                            $em->flush();
                            $id_universite = $this->universite;
                            $universites = $id_universite->getLibele();
                        } else {
                            $id_universite = $universite_existe;
                            $universites = $id_universite->getLibele();
                        }

                        if (isset($id_universite) && isset($id_diplome) && isset($id_ville)) {
                            $this->dmd_formation->setIdDemandeur($id_demandeur);
                            $this->dmd_formation->setIdCvs($id_cvs);
                            $this->dmd_formation->setVilleId($id_ville);
                            $this->dmd_formation->setVille($ville_for);
                            $this->dmd_formation->setDiplome($id_diplome);
                            $this->dmd_formation->setDiplomes($diplomes);
                            $this->dmd_formation->setUniversite($id_universite);
                            $this->dmd_formation->setuniversites($universites);
                            $this->dmd_formation->setVille($ville_for);
                            $this->dmd_formation->setAnnee($form_formation->get('annee')->getData());
                            $em->persist($this->dmd_formation);
                            $em->flush();
                        }

//                        // demandeur experience
//
                        $ville_experience = $repo_ville->findOneBy(['libele' => $form_experience->get('ville')->getData()]);
                        if ($ville_experience == null || !$ville_experience) {
                            $this->ville_exp->setLibele($form_experience->get('ville')->getData());
                            $this->ville_exp->setEtat('1');
                            $this->ville_exp->setCreated($this->date_created);
                            $em->persist($this->ville_exp);
                            $em->flush();
                            $id_vil = $this->ville_exp;
                            $ville = $id_vil->getLibele();
                        } else {
                            $id_vil = $ville_experience;
                            $ville = $ville_experience->getLibele();
                        }

                        $secteur_activite = $form_experience->get('secteuractivite_id')->getData();
                        if ($secteur_activite != null && !empty($secteur_activite)) {
                            $id_sectAct = $secteur_activite->getId();
                            $secteur_activites = $repo_secteur->find($id_sectAct);
                            $secteur_activit = $secteur_activites->getLibele();
                        }

                        $poste_exist = $repo_poste->findOneBy(['libele' => $form_experience->get('posteOccupe')->getData()]);
                        if ($poste_exist === null || !$poste_exist) {
                            $this->poste->setLibele($form_experience->get('posteOccupe')->getData());
                            $this->poste->setEtat('1');
                            $this->poste->setCreated($this->date_created);
                            $em->persist($this->poste);
                            $em->flush();
                            $post_id = $this->poste;
                            $poste_occupe = $post_id->getLibele();
                        } else {
                            $post_id = $poste_exist;
                            $poste_occupe = $post_id->getLibele();
                        }

                        if (isset($id_vil) && isset($secteur_activite)) {
                            $this->dmd_experience->setIdDemandeur($id_demandeur);
                            $this->dmd_experience->setIdCv($id_cvs);
                            $this->dmd_experience->setVilleId($id_vil);
                            $this->dmd_experience->setVille($ville);
                            $this->dmd_experience->setPosteoccupeId($post_id);
                            $this->dmd_experience->setPosteOccupe($poste_occupe);
                            $this->dmd_experience->setSecteuractiviteId($secteur_activites);
                            $this->dmd_experience->setSecteurActivite($secteur_activit);
                            $em->persist($this->dmd_experience);
                            $em->persist($form_experience->getData());
                            $em->flush();
                        }
                    }

                }

            } else {
                return new Response('Votre email est déjà utilisé, veuillez le changer pour pouvoir insérer un nouveau CV.');
            }

            return $this->redirectToRoute('admin_demandeur_show');
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
    public function showCVAction()
    {
        $demandeur_cv = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs');
        $all_cv = $demandeur_cv->findAll();
        return $this->view('show.html.twig', array('all_cv' => $all_cv));
    }

    /**
     * @Route("/demandeur/edit/{id}", name="admin_demandeur_edit")
     */
    public function editCVAction(Request $request)
    {
        $form_emplois = $this->createForm(epizy_demandeur_emploisType::class, $this->dmd_emplois);
        $form_cvs = $this->createForm(epizy_demandeur_cvsType::class, $this->dmd_cvs);
        $form_formation = $this->createForm(epizy_demandeur_formationsType::class, $this->dmd_formation);
        $form_experience = $this->createForm(epizy_demandeur_experienceType::class, $this->dmd_experience);

        $form = $this->createFormBuilder(FormType::class)
            ->setAction($this->generateUrl('admin_demandeur_edit', array('id' => $request->get('id'))))
            ->setMethod('post')
            ->getForm();


        if ( $request->isMethod('GET')){
            $id_cv = $request->get('id');
            $d_cv = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs')->find($id_cv);
            $id_demandeur = $d_cv->getIdDemandeur();
            $dEmploi = $this->getRepositoryClass('AdminBundle:epizy_demandeur_emplois')->find($id_demandeur);
            $id_cv = $d_cv->getId();
            $d_formation = $this->getRepositoryClass('AdminBundle:epizy_demandeur_formations')->findBy(['id_cvs' => $id_cv]);
            $d_experiences = $this->getRepositoryClass('AdminBundle:epizy_demandeur_experience')->findBy(['id_cv' => $id_cv]);
            return $this->view('edit.html.twig',
                array(
                    'form_emplois' => $form_emplois->createView(),
                    'form_cvs' => $form_cvs->createView(),
                    'form_formation' => $form_formation->createView(),
                    'form_experience' => $form_experience->createView(),
                    'form' => $form->createView(),
                    'dEmploi' => $dEmploi,
                    'd_cv'=>$d_cv,
                    'd_formation'=>$d_formation,
                    'd_experiences'=>$d_experiences
                )
            );
        }else{
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $form_emplois->handleRequest($request);
                $form_cvs->handleRequest($request);
                $form_formation->handleRequest($request);
                $form_experience->handleRequest($request);

                $repo_ville = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_villes');
                $repo_dmd = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_emplois');
                $repo_emp = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_emploi_recherches');
                $repo_log = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_logiciels');
                $repo_lang = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_langues');
                $repo_diplo = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes');
                $repo_certificat = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_certifications');
                $repo_secteur = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_secteur_activites');
                $repo_poste = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_poste_occupes');
                $repo_universite = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_universites');
                $repo_form = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_formations');

                $this->users->setName($form_emplois->get('nom')->getData());
                $this->users->setEmail($form_emplois->get('email')->getData());
                $this->users->setSeoname($form_emplois->get('prenom')->getData());
                $this->users->setCreated($this->date_created);
                $this->users->setStatus('0');
                $form_emplois->get('photo')->getData() == null ? $this->users->setHasImage('0') : $this->users->setHasImage('1');
                $em->persist($this->users);
                $em->flush();
                $id_user = $this->users;

                /* get and insert ville demandeur emploi*/
                $ville_emploi = $repo_ville->findOneBy(['libele' => $form_emplois->get('ville')->getData()]);

                if ($ville_emploi === null || !$ville_emploi) {
                    $this->ville_emp->setLibele($form_emplois->get('ville')->getData());
                    $this->ville_emp->setEtat('1');
                    $this->ville_emp->setCreated($this->date_created);
                    $em->persist($this->ville_emp);
                    $em->flush();
                    $ville_id = $this->ville_emp;
                    $ville_emp = $ville_id->getLibele();
                } else {
                    $ville_id = $ville_emploi;
                    $ville_emp = $ville_id->getLibele();
                }

                $new_choixEmploi = $form_emplois->get('new_choixEmploi')->getData();
                if ($new_choixEmploi != '' && isset($new_choixEmploi)) {
                    $choixExist = $repo_emp->findOneBy(['libele' => $new_choixEmploi]);
                    if ($choixExist == null || !$choixExist) {
                        $this->dmd_emplois->setChoixEmploi($new_choixEmploi);
                    } else {
                        $choixEmploi_existe = $choixExist->getLibele();
                        $this->dmd_emplois->setChoixEmploi($choixEmploi_existe);
                    }
                } else {
                    $choixEmploi = $form_emplois->get('choixEmploi')->getData();
                    if ($choixEmploi == null) {
                        $this->dmd_emplois->setChoixEmploi('Toutes les offres d\'emploi');
                    } else {
                        $this->dmd_emplois->setChoixEmploi($choixEmploi->getLibele());
                    }
                }

                $new_choixFormation = $form_emplois->get('new_choixFormation')->getData();
                $choixFormation = $form_emplois->get('choixFormation')->getData();

                if ($new_choixFormation != '' && isset($new_choixFormation)) {
                    $choixExist = $repo_dmd->findOneBy(['choixFormation' => $new_choixFormation]);
                    if ($choixExist == null || !$choixExist) {
                        $this->dmd_emplois->setChoixFormation($new_choixFormation);
                    } else {
                        $this->dmd_emplois->setChoixFormation($choixExist->getChoixFormation());
                    }
                } else {
                    if ($choixFormation == null) {
                        $this->dmd_emplois->setChoixFormation('Toutes les formations');
                    } else {
                        $this->dmd_emplois->setChoixFormation($choixFormation->getChoixFormation());
                    }
                }

                /* insert image*/
                $photo = $form_emplois->get('photo')->getData();
                if ($photo != '' && isset($photo)) {
                    $fileNames = $this->upload($photo);
                    if ($fileNames !== false) {
                        $this->dmd_emplois->setPhoto($fileNames);
                    } else {
                        return new Response('Votre photo n\'est pas jpeg/jpg');
                    }
                }

                $id_demandeur = null;
                if ($id_user != null && $ville_id != null) {
                    $this->dmd_emplois->setIdUser($id_user);
                    $this->dmd_emplois->setVilleId($ville_id);
                    $this->dmd_emplois->setVille($ville_emp);
                    $em->persist($this->dmd_emplois);
                    $em->persist($form_emplois->getData());
                    $em->flush();
                    $id_demandeur = $this->dmd_emplois;
                }

                if ($id_demandeur != null) {

                    $emploi = $form_cvs->get('emploiRecherche')->getData();

                    if ($emploi != '' && isset($emploi)) {
                        $emploi_exist = $repo_emp->findOneBy(['libele' => $emploi]);
                        if ($emploi_exist == null || !$emploi_exist) {
                            $this->emploi_recherche->setLibele($form_cvs->get('emploiRecherche')->getData());
                            $this->emploi_recherche->setEtat('1');
                            $this->emploi_recherche->setCreated($this->date_created);
                            $em->persist($this->emploi_recherche);
                            $em->flush();
                            $emploi_recherche_id = $this->emploi_recherche;
                            $emploi_recherche = $emploi_recherche_id->getLibele();
                        } else {
                            $emploi_recherche_id = $emploi_exist;
                            $emploi_recherche = $emploi_recherche_id->getLibele();
                        }
                    } else {
                        $emploi_rech = $form_cvs->get('emploiRechercheId')->getData();
                        $emploi_recherche_id = $emploi_rech;
                        $emploi_recherche = $emploi_recherche_id->getLibele();
                    }

                    $logId = $form_cvs->get('logicielId')->getData();
                    $log = $form_cvs->get('logiciel')->getData();

                    if ($log != '' && isset($log)) {
                        $logiciel_exist = $repo_log->findOneBy(['libele' => $log]);
                        if ($logiciel_exist == null || !$logiciel_exist) {
                            $this->logiciel->setLibele($form_cvs->get('logiciel')->getData());
                            $this->logiciel->setEtat('0');
                            $this->logiciel->setCreated($this->date_created);
                            $em->persist($this->logiciel);
                            $em->flush();
                            $logiciel_id = $this->logiciel;
                            $logiciel = $logiciel_id->getLibele();
                        } else {
                            $logiciel_id = $logiciel_exist;
                            $logiciel = $logiciel_id->getLibele();
                        }
                    } else {
                        $logiciel_id = $logId;
                        $logiciel = $logiciel_id->getLibele();
                    }

                    $langueId = $form_cvs->get('langueId')->getData();
                    $langues = $form_cvs->get('langue')->getData();
                    $langue_exist = $repo_lang->findOneBy(['nom' => $langues]);

                    if ($langues != '' && isset($langues)) {
                        if ($langue_exist == null || !$langue_exist) {
                            $this->langue->setNom($form_cvs->get('langue')->getData());
                            $this->langue->setEtat('0');
                            $this->langue->setCreated($this->date_created);
                            $em->persist($this->langue);
                            $em->flush();
                            $langue_id = $this->langue;
                            $langue = $langue_id->getNom();
                        } else {
                            $langue_id = $langue_exist;
                            $langue = $langue_id->getNom();
                        }
                    } else {
                        $langue_id = $langueId;
                        $langue = $langue_id->getNom();
                    }

                    $certificat_id = null;
                    $certificats = $form_cvs->get('centreInteretCertificat')->getData();
                    if (isset($certificats) || !empty($certificats)) {
                        $certificat_exist = $repo_certificat->findOneBy(['libele' => $certificats]);
                        if (!$certificat_exist || $certificat_exist == null) {
                            $this->certificat->setLibele($certificats);
                            $this->certificat->setEtat('0');
                            $this->certificat->setCreated($this->date_created);
                            $em->persist($this->certificat);
                            $em->flush();
                            $certificat_id = $this->certificat;
                        } else {
                            $certificat_id = $certificat_exist;
                        }
                    }

                    $id_cvs = null;
                    if (isset($emploi_recherche_id) && !empty($emploi_recherche_id)) {

                        $this->dmd_cvs->setEmploirechercheId($emploi_recherche_id);
                        $this->dmd_cvs->setEmploirecherche($emploi_recherche);
                        $this->dmd_cvs->setLogicielId($logiciel_id);
                        $this->dmd_cvs->setLogiciel($logiciel);
                        $this->dmd_cvs->setCertificationId($certificat_id);
                        $this->dmd_cvs->setIdDemandeur($id_demandeur);
                        $this->dmd_cvs->setLangueId($langue_id);
                        $this->dmd_cvs->setLangue($langue);
                        $this->dmd_cvs->setDateCreation($this->date_created);
                        $this->dmd_cvs->setNbrVue('0');
                        $this->dmd_cvs->setReference('CV_' . $id_demandeur->getId());
                        $this->dmd_cvs->setStatu('1');
                        $permis_array = $form_cvs->get('permis')->getData();
                        $permis = implode(',', $permis_array);
                        $this->dmd_cvs->setPermis($permis);
                        $em->persist($this->dmd_cvs);
                        $em->persist($form_cvs->getData());
                        $em->flush();
                        $id_cvs = $this->dmd_cvs;
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
                            $ville_for = $this->ville_for->getLibele();
                        } else {
                            $id_ville = $ville_formation->getId();
                            $ville_for = $ville_formation->getLibele();
                        }

                        $diplome_exist = $repo_diplo->findOneBy(['libele' => $form_formation->get('diplomes')->getData()]);
                        if ($diplome_exist === null || !$diplome_exist) {
                            $this->diplome->setLibele($form_formation->get('diplomes')->getData());
                            $this->diplome->setEtat('1');
                            $this->diplome->setCreated($this->date_created);
                            $em->persist($this->diplome);
                            $em->flush();
                            $id_diplome = $this->diplome;
                            $diplomes = $id_diplome->getLibele();
                        } else {
                            $id_diplome = $diplome_exist;
                            $diplomes = $id_diplome->getLibele();
                        }

                        $universite_existe = $repo_universite->findOneBy(['libele' => $form_formation->get('universites')->getData()]);
                        if ($universite_existe == null || !$universite_existe) {
                            $this->universite->setLibele($form_formation->get('universites')->getData());
                            $this->universite->setEtat('1');
                            $this->universite->setCreated($this->date_created);
                            $em->persist($this->universite);
                            $em->flush();
                            $id_universite = $this->universite;
                            $universites = $id_universite->getLibele();
                        } else {
                            $id_universite = $universite_existe;
                            $universites = $id_universite->getLibele();
                        }

                        if (isset($id_universite) && isset($id_diplome) && isset($id_ville)) {
                            $this->dmd_formation->setIdDemandeur($id_demandeur);
                            $this->dmd_formation->setIdCvs($id_cvs);
                            $this->dmd_formation->setVilleId($id_ville);
                            $this->dmd_formation->setVille($ville_for);
                            $this->dmd_formation->setDiplome($id_diplome);
                            $this->dmd_formation->setDiplomes($diplomes);
                            $this->dmd_formation->setUniversite($id_universite);
                            $this->dmd_formation->setuniversites($universites);
                            $this->dmd_formation->setVille($ville_for);
                            $this->dmd_formation->setAnnee($form_formation->get('annee')->getData());
                            $em->persist($this->dmd_formation);
                            $em->flush();
                        }

                        //                        // demandeur experience
                        //
                        $ville_experience = $repo_ville->findOneBy(['libele' => $form_experience->get('ville')->getData()]);
                        if ($ville_experience == null || !$ville_experience) {
                            $this->ville_exp->setLibele($form_experience->get('ville')->getData());
                            $this->ville_exp->setEtat('1');
                            $this->ville_exp->setCreated($this->date_created);
                            $em->persist($this->ville_exp);
                            $em->flush();
                            $id_vil = $this->ville_exp;
                            $ville = $id_vil->getLibele();
                        } else {
                            $id_vil = $ville_experience;
                            $ville = $ville_experience->getLibele();
                        }

                        $secteur_activite = $form_experience->get('secteuractivite_id')->getData();
                        if ($secteur_activite != null && !empty($secteur_activite)) {
                            $id_sectAct = $secteur_activite->getId();
                            $secteur_activites = $repo_secteur->find($id_sectAct);
                            $secteur_activit = $secteur_activites->getLibele();
                        }

                        $poste_exist = $repo_poste->findOneBy(['libele' => $form_experience->get('posteOccupe')->getData()]);
                        if ($poste_exist === null || !$poste_exist) {
                            $this->poste->setLibele($form_experience->get('posteOccupe')->getData());
                            $this->poste->setEtat('1');
                            $this->poste->setCreated($this->date_created);
                            $em->persist($this->poste);
                            $em->flush();
                            $post_id = $this->poste;
                            $poste_occupe = $post_id->getLibele();
                        } else {
                            $post_id = $poste_exist;
                            $poste_occupe = $post_id->getLibele();
                        }

                        if (isset($id_vil) && isset($secteur_activite)) {
                            $this->dmd_experience->setIdDemandeur($id_demandeur);
                            $this->dmd_experience->setIdCv($id_cvs);
                            $this->dmd_experience->setVilleId($id_vil);
                            $this->dmd_experience->setVille($ville);
                            $this->dmd_experience->setPosteoccupeId($post_id);
                            $this->dmd_experience->setPosteOccupe($poste_occupe);
                            $this->dmd_experience->setSecteuractiviteId($secteur_activites);
                            $this->dmd_experience->setSecteurActivite($secteur_activit);
                            $em->persist($this->dmd_experience);
                            $em->persist($form_experience->getData());
                            $em->flush();
                        }
                    }
                }

                return $this->redirectToRoute('admin_demandeur_show');
            }

            dump($form->getErrors());
            dump($form_emplois->getErrors());
            dump($form_experience->getErrors());
            dump($form_formation->getErrors());
            dump($form_cvs->getErrors());
            die();
        }
    }


//    /**
//     * @Route("/demandeur/update", name="admin_demandeur_update")
//     */
//    public function updateCVAction(Request $request){
//
//    }

    /**
     * @Route("/demandeur/delete/{id}", name="admin_demandeur_delete")
     */
    public function deleteAction(Request $request)
    {
        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();
            $id = intval($request->get('id'));
            if ($id != 0 || $id != null) {
                $cv = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs')->find($id);
                $emploi = $cv->getIdDemandeur();
                $user = $emploi->getIdUser();
                $experience = $this->getRepositoryClass('AdminBundle:epizy_demandeur_experience')->findBy(['id_cv' => $cv->getId()]);
                if ($experience != null && $experience != '') {
                    foreach ($experience as $exp) {
                        $em->remove($exp);
                        $em->flush();
                    }
                }
                $formation = $this->getRepositoryClass('AdminBundle:epizy_demandeur_formations')->findBy(['id_cvs' => $cv->getId()]);
                if ($formation != null && $formation != '') {
                    foreach ($formation as $form) {
                        $em->remove($form);
                        $em->flush();
                    }
                }
                $em->remove($cv);
                if ($emploi != null) {
                    $em->remove($emploi);
                }
                if ($user != null) {
                    $em->remove($user);
                }
                $em->flush();
            }

            return $this->redirectToRoute("admin_demandeur_show");
        }
        return $this->redirectToRoute("admin_demandeur_show");
    }

    private function getRepositoryClass($entity_bundle)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository($entity_bundle);
        return $repository;
    }

    public function view($field, $data = array())
    {
        return $this->render('AdminBundle:Demandeur:' . $field, $data);
    }

    public function upload(UploadedFile $file)
    {
        if ( $file->guessExtension() == 'jpeg' || $file->guessExtension() == 'jpg'){
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'), $fileName);
            return $fileName;
        }
        return false ;
    }

}