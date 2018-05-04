<?php

namespace AdminBundle\Controller;

use AdminBundle\AdminBundle;
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
use Doctrine\Common\Collections\ArrayCollection;
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
        $form_emplois   = $this->createForm(epizy_demandeur_emploisType::class, $this->dmd_emplois);
        $form_cvs       = $this->createForm(epizy_demandeur_cvsType::class, $this->dmd_cvs);
        $form = $this->createFormBuilder(FormType::class)->setAction('')->setMethod('post')->getForm();
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $form_emplois->handleRequest($request);
            $form_cvs->handleRequest($request);

            $repo_users = $this->getDoctrine()->getManager()->getRepository('AppBundle:epizy_users');
            $repo_ville = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_villes');
            $repo_dmd = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_demandeur_emplois');
            $repo_emp = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_emploi_recherches');
            $repo_log = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_logiciels');
            $repo_lang = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_langues');
            $repo_diplo = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_diplomes');
            $repo_certificat = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_certifications');
            $repo_poste = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_poste_occupes');
            $repo_universite = $this->getDoctrine()->getManager()->getRepository('AdminBundle:epizy_universites');

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
                    $telephones  = implode(",", $form_emplois->get('telephone')->getData());
                    $this->dmd_emplois->setIdUser($id_user);
                    $this->dmd_emplois->setVilleId($ville_id);
                    $this->dmd_emplois->setVille($ville_emp);
                    $this->dmd_emplois->setTelephone($telephones);
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

                    if (isset($emploi_recherche_id) && !empty($emploi_recherche_id)) {
                        if ( $form_cvs->get('position')->getData() === null ){
                            $position = false;
                        }else{
                            $position = true;
                        }

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
                        $this->dmd_cvs->setPosition($position);
                        $permis_array = $form_cvs->get('permis')->getData();
                        $permis = implode(',', $permis_array);
                        $this->dmd_cvs->setPermis($permis);

                        foreach ( $this->dmd_cvs->getFormations() as $value) {
                            /** @var  epizy_demandeur_formations $value */
                            $ville_formation = $repo_ville->findOneBy(['libele' => $value->getVille()]);
                            //$this->ville_for = null ;
                            if ($ville_formation === null || !$ville_formation) {
                                $this->ville_for->setLibele($value->getVille());
                                $this->ville_for->setEtat('1');
                                $this->ville_for->setCreated($this->date_created);
                                $em->persist($this->ville_for);
                                $em->flush();
                                $value->setVilleId($this->ville_for);
                                $value->setVille($this->ville_for->getLibele());
                                $this->ville_for = new epizy_villes();

                            } else {
                                $value->setVilleId($ville_formation);
                                $value->setVille( $ville_formation->getLibele());
                            }

                            $diplome_exist = $repo_diplo->findOneBy(['libele' => $value->getDiplomes()]);
                            if ($diplome_exist === null || !$diplome_exist) {
                                $this->diplome->setLibele($value->getDiplomes());
                                $this->diplome->setEtat('1');
                                $this->diplome->setCreated($this->date_created);
                                $em->persist($this->diplome);
                                $value->setDiplome($this->diplome);
                                $value->setDiplomes($this->diplome->getLibele());
                                $this->diplome = new epizy_diplomes();
                            } else {
                                $value->setDiplome($diplome_exist);
                                $value->setDiplomes($diplome_exist->getLibele());
                            }

                            $universite_existe = $repo_universite->findOneBy(['libele' => $value->getuniversites()]);
                            if ($universite_existe == null || !$universite_existe) {
                                $this->universite->setLibele($value->getuniversites());
                                $this->universite->setEtat('1');
                                $this->universite->setCreated($this->date_created);
                                $em->persist($this->universite);
                                $em->flush();
                                $value->setUniversite($this->universite);
                                $value->setUniversites($this->universite->getLibele());
                                $this->universite = new epizy_universites() ;
                            } else {
                                $value->setUniversite($universite_existe);
                                $value->setUniversites($universite_existe->getLibele());
                            }

                            $value->setIdDemandeur($id_demandeur );
                            $value->setAnnee($value->getAnnee());
                            $value->setPays($value->getPays());
                        }

                        $experiences =  $this->dmd_cvs->getExperiences() ;
                        foreach ($experiences as $experience){
                            /** @var epizy_demandeur_experience $experience */
                            $ville_experience = $repo_ville->findOneBy(['libele' => $experience->getVille()]);
                            if ($ville_experience == null || !$ville_experience) {
                                $this->ville_exp->setLibele($experience->getVille());
                                $this->ville_exp->setEtat('1');
                                $this->ville_exp->setCreated($this->date_created);
                                $em->persist($this->ville_exp);
                                $em->flush();
                                $experience->setVilleId($this->ville_exp);
                                $experience->setVille($this->ville_exp->getLibele());
                                $this->ville_exp = new epizy_villes() ;
                            } else {
                                $experience->setVilleId($ville_experience);
                                $experience->setVille($ville_experience->getLibele());
                            }

                            $secteur_activite = $experience->getSecteurActiviteId();

                            if ($secteur_activite != null && !empty($secteur_activite)) {
                                $id_sectAct         = $secteur_activite->getId();
                                $secteur_activit    = $secteur_activite->getLibele();
                            }

                            $poste_exist = $repo_poste->findOneBy(['libele' => $experience->getPosteOccupe()]);
                            if ($poste_exist === null || !$poste_exist) {
                                $this->poste->setLibele($experience->getPosteOccupe());
                                $this->poste->setEtat('1');
                                $this->poste->setCreated($this->date_created);
                                $em->persist($this->poste);
                                $em->flush();

                                $experience->setPosteoccupeId($this->poste);
                                $experience->setPosteOccupe($this->poste->getLibele());
                                $this->poste = new epizy_poste_occupes() ;
                            } else {
                                $experience->setPosteoccupeId($poste_exist);
                                $experience->setPosteOccupe($poste_exist->getLibele());
                            }

                            $experience->setIdDemandeur($id_demandeur);
                            $experience->setSecteuractiviteId($secteur_activite);
                            $experience->setSecteurActivite($secteur_activit);
                            $experience->setMoisDebut($experience->getMoisDebut());
                            $experience->setMoisFin($experience->getMoisFin());
                            $experience->setAnnee($experience->getAnnee());
                            $experience->setPays($experience->getPays());
                            $experience->setNomEntreprise($experience->getNomEntreprise());
                            $experience->setMissionTache($experience->getMissionTache());
                        }
                        $em->persist($this->dmd_cvs);
                        $em->flush() ;
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
        if ( $request->isMethod('GET')){
            $id_cv          = $request->get('id');
            if ( is_numeric($id_cv) ){
                $dCv            = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs')->find($id_cv);
                $id_demandeur   = $dCv->getIdDemandeur();
                $form_cvs       = $this->createForm(epizy_demandeur_cvsType::class, $dCv);
                $form_emplois   = $this->createForm(epizy_demandeur_emploisType::class, $id_demandeur);
                $permis         = explode(",",$dCv->getPermis() ) ;

                $form = $this->createFormBuilder(FormType::class)
                    ->setAction($this->generateUrl('admin_demandeur_update', array('id' => $id_cv ) ))
                    ->setMethod('post')
                    ->getForm();

                return $this->view('edit.html.twig',
                    array(
                        'form_emplois'  => $form_emplois->createView(),
                        'form_cvs'      => $form_cvs->createView(),
                        'form'          => $form->createView(),
                        'id'            => $id_cv,
                        'permis'        => $permis
                    )
                );
            }else{
                return new Response(' C V introuvable ') ;
            }
        }else{
            return $this->redirectToRoute('admin_demandeur_show');
        }

    }

    /**
     * @Route("/demandeur/update/{id}", name="admin_demandeur_update")
     */
    public function updateCVAction(Request $request){

        $form_emplois    = $this->createForm(epizy_demandeur_emploisType::class, $this->dmd_emplois);
        $form_cvs        = $this->createForm(epizy_demandeur_cvsType::class, $this->dmd_cvs);
        /*** @var $dmdCv epizy_demandeur_cvs  */

        $id         = $request->get('id');
        $dmdCv      = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs')->find($id);
        $user       = $dmdCv->getIdDemandeur()->getIdUser() ;
        $dmdEmploi  = $dmdCv->getIdDemandeur() ;
        $empRecherc  = $dmdCv->getEmploirechercheId() ;
        $logic      = $dmdCv->getLogicielId();
        $alLogiciel = $this->getRepositoryClass('AdminBundle:epizy_logiciels')->findBy(['id'=>$logic->getId()]);
        $langs      = $dmdCv->getLangueId();
        $alLangue   =  $this->getRepositoryClass('AdminBundle:epizy_langues')->findBy(['id'=>$langs->getId()]);
        $certifica  = $dmdCv->getCertificationId() ;
        $allCertifica =  $this->getRepositoryClass('AdminBundle:epizy_certifications')->findBy(['id'=>$certifica->getId()]);
        $allFormation = $this->getRepositoryClass('AdminBundle:epizy_demandeur_formations')->findBy(['id_cvs' => $dmdCv->getId()] );
        $allExperience= $this->getRepositoryClass('AdminBundle:epizy_demandeur_experience')->findBy(['id_cv' => $dmdCv->getId()] );

        $form       = $this->createFormBuilder(FormType::class)
            ->setAction($this->generateUrl('admin_demandeur_update', array('id' => $id) ))
            ->setMethod('post')
            ->getForm();
        if ( $request->isMethod('POST')){
            $form->handleRequest($request);
            if ( $form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $form_emplois->handleRequest($request);
                $form_cvs->handleRequest($request);
                $repo_ville = $this->getRepositoryClass('AdminBundle:epizy_villes');
                $repo_dmd = $this->getRepositoryClass('AdminBundle:epizy_demandeur_emplois');
                $repo_emp = $this->getRepositoryClass('AdminBundle:epizy_emploi_recherches');
                $repo_log = $this->getRepositoryClass('AdminBundle:epizy_logiciels');
                $repo_lang = $this->getRepositoryClass('AdminBundle:epizy_langues');
                $repo_diplo = $this->getRepositoryClass('AdminBundle:epizy_diplomes');
                $repo_certificat = $this->getRepositoryClass('AdminBundle:epizy_certifications');
                $repo_secteur = $this->getRepositoryClass('AdminBundle:epizy_secteur_activites');
                $repo_poste = $this->getRepositoryClass('AdminBundle:epizy_poste_occupes');
                $repo_universite = $this->getRepositoryClass('AdminBundle:epizy_universites');
                $repo_form = $this->getRepositoryClass('AdminBundle:epizy_demandeur_formations');

                /**user**/
                $user->setName($form_emplois->get('nom')->getData());
                $user->setSeoname($form_emplois->get('prenom')->getData());
                $form_emplois->get('photo')->getData() == null ? $user->setHasImage('0') : $user->setHasImage('1');
                $em->persist($user);
                $em->flush();
                $id_user = $user;
                /*** fin user ***/
                /** ville demandeur emplois*/
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
                /** fin ville demandeur emplois*/
                /** choix emploi demandeur emplois*/
                $new_choixEmploi = $form_emplois->get('new_choixEmploi')->getData();
                if ($new_choixEmploi != '' && isset($new_choixEmploi)) {
                    $choixExist = $repo_emp->findOneBy(['libele' => $new_choixEmploi]);
                    if ($choixExist == null || !$choixExist) {
                        $this->emploi_recherche->setLibele($new_choixEmploi);
                        $this->emploi_recherche->setEtat('1');
                        $this->emploi_recherche->setCreated($this->date_created);
                        $em->persist($this->emploi_recherche);
                        $em->flush();
                        $choixEmploi = $this->emploi_recherche ;
                        $dmdEmploi->setChoixEmploi($choixEmploi->getLibele());
                    } else {
                        $choixEmploi_existe = $choixExist->getLibele();
                        $dmdEmploi->setChoixEmploi($choixEmploi_existe);
                    }
                } else {
                    $choixEmploi = $form_emplois->get('choixEmploi')->getData();
                    if ($choixEmploi === null) {
                        $dmdEmploi->setChoixEmploi('Toutes les offres d\'emploi');
                    } else {
                        $dmdEmploi->setChoixEmploi($choixEmploi->getLibele());
                    }
                }
                /** fin choix emploi demandeur emplois*/
                /** choix formation demandeur emplois*/
                $new_choixFormation = $form_emplois->get('new_choixFormation')->getData();
                $choixFormation     = $form_emplois->get('choixFormation')->getData();
                if ($new_choixFormation != '' && isset($new_choixFormation)) {
                    $choixExist = $repo_dmd->findOneBy(['choixFormation' => $new_choixFormation]);
                    if ($choixExist == null || !$choixExist) {
                        $dmdEmploi->setChoixFormation($new_choixFormation);
                    } else {
                        $dmdEmploi->setChoixFormation($choixExist->getChoixFormation());
                    }
                } else {
                    if ($choixFormation == null) {
                        $dmdEmploi->setChoixFormation('Toutes les formations');
                    } else {
                        $dmdEmploi->setChoixFormation($choixFormation->getChoixFormation());
                    }
                }
                /** fin choix formation demandeur emplois*/
                /** insert image*/
                $photo = $form_emplois->get('photo')->getData();
                if ($photo != '' && isset($photo)) {
                    if (!is_string($photo)){
                        $fileNames = $this->upload($photo);
                        if ($fileNames !== false) {
                            $dmdEmploi->setPhoto($fileNames);
                        } else {
                            return new Response('Votre photo n\'est pas jpeg/jpg');
                        }
                    }
                }
                /**@var $dmdEmploi epizy_demandeur_emplois*/
                $dmdEmploi->setVilleId($ville_id);
                $dmdEmploi->setVille($ville_emp);
                $dmdEmploi->setEmploiTrouve($form_emplois->get('emploiTrouve')->getData());
                $dmdEmploi->setAudition($form_emplois->get('audition')->getData());
                $dmdEmploi->setAdresse($form_emplois->get('adresse')->getData());
                $dmdEmploi->setNom($form_emplois->get('nom')->getData());
                $dmdEmploi->setPrenom($form_emplois->get('prenom')->getData());
                $dmdEmploi->setStatus($form_emplois->get('status')->getData());
                $dmdEmploi->setTitre($form_emplois->get('titre')->getData());
                $telephones = implode(",",$form_emplois->get('telephone')->getData() );
                $dmdEmploi->setTelephone($telephones);
                $dmdEmploi->setRegion($form_emplois->get('region')->getData());
                $dmdEmploi->setDateDeNaissance($form_emplois->get('dateDeNaissance')->getData());
                $dmdEmploi->setNotificationEmploiPoste($form_emplois->get('notificationEmploiPoste')->getData());
                $dmdEmploi->setNotificationFormationPoste($form_emplois->get('notificationFormationPoste')->getData());
                $dmdEmploi->setNewsletter($form_emplois->get('newsletter')->getData());
                $em->persist($dmdEmploi);
                $em->flush();
                $id_demandeur = $dmdEmploi;
                /*** fin flush demandeur emplois **/

                if ($id_demandeur != null) {
                    $emploi = $form_cvs->get('emploiRecherche')->getData();
                    if ($emploi != '' && isset($emploi)) {
                        $emploi_exist = $repo_emp->findOneBy(['libele' => $emploi]);
                        if ($emploi_exist == null || !$emploi_exist) {
                            $this->emploi_recherche->setLibele($form_cvs->get('emploiRecherche')->getData());
                            $empRecherc->setEtat('1');
                            $empRecherc->setCreated($this->date_created);
                            $em->persist($empRecherc);
                            $em->flush();
                            $emploi_recherche_id = $empRecherc;
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
                            $this->logiciel->setEtat('1');
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
                            $this->langue->setEtat('1');
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

                    $certificats = $form_cvs->get('centreInteretCertificat')->getData();
                    if (isset($certificats) || !empty($certificats)) {
                        $certificat_exist = $repo_certificat->findOneBy(['libele' => $certificats]);
                        if (!$certificat_exist || $certificat_exist == null) {
                            $this->certificat->setLibele($certificats);
                            $this->certificat->setEtat('1');
                            $this->certificat->setCreated($this->date_created);
                            $em->persist($this->certificat);
                            $em->flush();
                            $certificat_id = $this->certificat;
                        } else {
                            $certificat_id = $certificat_exist;
                        }
                    }

                    // formation et experience
                    $formation_value = $form_cvs->get('formations')->getData();
                    if ($formation_value) {
                        foreach ($formation_value as $formation) {
                            $ville_formation = $repo_ville->findOneBy(['libele' => $formation->getVille()]);
                            if ($ville_formation === null || !$ville_formation) {
                                $this->ville_for->setLibele($formation->getVille());
                                $this->ville_for->setEtat('1');
                                $this->ville_for->setCreated($this->date_created);
                                $em->persist($this->ville_for);
                                $em->flush();
                                $id_ville = $this->ville_for;
                                $ville_for = $this->ville_for->getLibele();
                                $this->ville_for = new epizy_villes();
                            } else {
                                $id_ville = $ville_formation;
                                $ville_for = $ville_formation->getLibele();
                            }

                            $diplome_exist = $repo_diplo->findOneBy(['libele' => $formation->getDiplomes()]);
                            if ($diplome_exist === null || !$diplome_exist) {
                                $this->diplome->setLibele($formation->getDiplomes());
                                $this->diplome->setEtat('1');
                                $this->diplome->setCreated($this->date_created);
                                $em->persist($this->diplome);
                                $em->flush();
                                $id_diplome = $this->diplome;
                                $diplomes = $id_diplome->getLibele();
                                $this->diplome = new epizy_diplomes();
                            } else {
                                $id_diplome = $diplome_exist;
                                $diplomes = $id_diplome->getLibele();
                            }

                            $universite_existe = $repo_universite->findOneBy(['libele' => $formation->getUniversites()]);
                            if ($universite_existe == null || !$universite_existe) {
                                $this->universite->setLibele($formation->getUniversites());
                                $this->universite->setEtat('1');
                                $this->universite->setCreated($this->date_created);
                                $em->persist($this->universite);
                                $em->flush();
                                $id_universite = $this->universite;
                                $universites = $id_universite->getLibele();
                                $this->universite = new epizy_universites();
                            } else {
                                $id_universite = $universite_existe;
                                $universites = $id_universite->getLibele();
                            }

                            if ($allFormation) {
                                foreach ($allFormation as $oformation) {
                                    $oformation->setVilleId($id_ville);
                                    $oformation->setVille($ville_for);
                                    $oformation->setDiplome($id_diplome);
                                    $oformation->setDiplomes($diplomes);
                                    $oformation->setUniversite($id_universite);
                                    $oformation->setuniversites($universites);
                                    $oformation->setAnnee($formation->getAnnee());
                                    $em->persist($oformation);
                                    $em->flush();
                                }
                            }
                        }
                    }


                    //                        // demandeur experience
                    $experience_value = $form_cvs->get('experiences')->getData() ;
                    if ($experience_value){
                        foreach ($experience_value as $oExperience){
                            $ville_experience = $repo_ville->findOneBy(['libele' => $oExperience->getVille()]);
                            if ($ville_experience == null || !$ville_experience) {
                                $this->ville_exp->setLibele($oExperience->getVille());
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

                            $secteur_activite = $oExperience->getSecteurActiviteId();
                            if (isset($secteur_activite)) {
                                $id_sectAct = $secteur_activite;
                                $secteur_activit = $secteur_activite->getLibele();
                            }

                            $poste_exist = $repo_poste->findOneBy(['libele' => $oExperience->getPosteOccupe()]);
                            if ($poste_exist === null || !$poste_exist) {
                                $this->poste->setLibele($oExperience->getPosteOccupe());
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

                            if ( $allExperience ){
                                foreach ($allExperience as $experience){
                                    $experience->setMoisDebut($oExperience->getMoisDebut());
                                    $experience->setMoisFin($oExperience->getMoisFin());
                                    $experience->setMissionTache($oExperience->getMissionTache());
                                    $experience->setAnnee($oExperience->getAnnee());
                                    $experience->setVilleId($id_vil);
                                    $experience->setVille($ville);
                                    $experience->setPosteoccupeId($post_id);
                                    $experience->setPosteOccupe($poste_occupe);
                                    $experience->setSecteuractiviteId($id_sectAct);
                                    $experience->setSecteurActivite($secteur_activit);
                                    $em->persist($experience);
                                    $em->flush();
                                }
                            }
                        }
                    }

                    if (isset($emploi_recherche_id) && !empty($emploi_recherche_id)) {
                        if ( $form_cvs->get('position')->getData() === null )
                            $position = 0;

                        $dmdCv->setEmploirechercheId($emploi_recherche_id);
                        $dmdCv->setEmploirecherche($emploi_recherche);
                        $dmdCv->setLogicielId($logiciel_id);
                        $dmdCv->setLogiciel($logiciel);
                        $dmdCv->setCertificationId($certificat_id);
                        $dmdCv->setLangueId($langue_id);
                        $dmdCv->setLangue($langue);
                        $dmdCv->setCertificationId($certificat_id);
                        $dmdCv->setCentreInteretProjet($form_cvs->get('centreInteretProjet')->getData());
                        $permis_array = $form_cvs->get('permis')->getData();
                        $permis = implode(',', $permis_array);
                        $dmdCv->setPermis($permis);
                        $dmdCv->setPosition($position);
                        $em->persist($dmdCv);
                        $em->flush();
                    }

                }
                return $this->redirectToRoute('admin_demandeur_show');
            }else{
                return $this->redirectToRoute('admin_demandeur_update', array('id'=>$id) );
            }
        }
        return $this->redirectToRoute('admin_demandeur_update', array('id'=>$id) );
    }

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

    /**
     * @Route("/demandeur/detail/{id}", name="admin_demandeur_detail")
     */
    public function detailAction(Request $request){
        if ($request->isMethod('GET')){
            $id_cv = intval( $request->get('id') ) ;
            if (is_int($id_cv) ) {
                $dmd_cv = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs');
                $detail = $dmd_cv->findOneBy(['id' => $id_cv]);
                return $this->view('detail.html.twig',array('detail' => $detail )) ;
            }
        }

        return $this->redirectToRoute("admin_demandeur_show");

    }

    /**
     * @Route("/demandeur/moderate" , name="admin_demandeur_moderate")
     */
    public function moderateAction(){
        $cv_desactive = $this->getRepositoryClass('AdminBundle:epizy_demandeur_cvs');
        $cv_desactives = $cv_desactive->findBy(['statu' => 0]);

        return $this->view('moderate.html.twig', array( 'cv_desactives' => $cv_desactives ) );
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