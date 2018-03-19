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
use AppBundle\Entity\epizy_users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Annotation\Route;
class EntrepriseController extends Controller
{
    /**
     * Matches /blog exactly
     *
     * @Route("/entreprise/index", name="admin_entreprise_index")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb ->select('e.id,e.idUser,e.nomEntreprise, e.secteurActivite, e.telMobilResponsable,e.emailResponsable, e.adressePhysique,e.notificationCvPoste, u.status')
            ->from('AdminBundle\Entity\epizy_entreprises', 'e')
            ->from('AppBundle\Entity\epizy_users', 'u')
            ->where('e.idUser = u.id');

        $listEntreprise= $qb->getQuery()->getResult();
         //var_dump($listEntreprise);
        return $this->render('AdminBundle:OffreEmploi:liste_entreprise.html.twig', array('listEntreprise'=>$listEntreprise));
    }

    /**
     *
     * @Route("/entreprise/filter/status=0", name="admin_entreprise_filter")
     */
    public function list_desactiveAction(){
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb ->select('e.id,e.idUser,e.nomEntreprise, e.secteurActivite, e.telMobilResponsable,e.emailResponsable, e.adressePhysique,e.notificationCvPoste, u.status')
            ->from('AdminBundle\Entity\epizy_entreprises', 'e')
            ->from('AppBundle\Entity\epizy_users', 'u')
            ->where('e.idUser = u.id')
            ->andWhere('u.status= 0');

        $listEntreprise= $qb->getQuery()->getResult();
        return $this->render('AdminBundle:OffreEmploi:liste_entreprise.html.twig', array('listEntreprise'=>$listEntreprise));
    }

    /**
     *
     * @Route("/entreprise/create", name="admin_entreprise_create")
     */
    public function createAction(Request $request){
        $entreprise     = new epizy_entreprises();
        $listeSecteur   = new epizy_secteur_activites();
        $listeSecteur   = $this->getDoctrine()->getManager()
                            ->getRepository('AdminBundle:epizy_secteur_activites')->findByEtat(1);
        $libelleSecteur = array();
                foreach ($listeSecteur as $secteur) {
                                 array_push($libelleSecteur,$secteur->getLibele());
                                }                         
        $entreprise -> setPrenomResponsable('null');
        $entreprise -> setRegion('null');
        $entreprise -> setProduitVendu('null');
        $entreprise -> setPhoto1('null');
        $entreprise -> setPhoto2('null');
        $entreprise -> setAutres('null');
        $entreprise -> setReference('null');

        $form = $this->createFormBuilder($entreprise)
            ->add('nom_entreprise', TextType::class,array(
                'label'=> 'Nom de l\'entreprise:' ,
                'attr' =>array('class'=>'form-control')
                ))
            ->add('adresse_physique', TextType::class,array(
                'label'=> 'Adresse physique de l\'entreprise:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('nif',TextType::class, array(
                'label'=>'Nif:',
                'attr' =>array('class'=>'form-control')))
            ->add('statistique', TextType::class,array(
                'label'=> 'Numéro statistique:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('tel_fixe_entreprise', TextType::class,array(
                'label'=> 'Téléphone fixe de l\'entreprie:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('titre',ChoiceType::class ,
                array('choices' =>array(
                      'Mr'  =>'Mr',
                      'Mme' =>'Mme',
                      'Mlle'=> 'Mlle'  ),
                    'attr'=>array('class'=>'form-control', /*'style'=>'width:9%'*/)
                     )
                )
            ->add('nom_responsable', TextType::class,array(
                'label'=> 'Nom du responsable',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('tel_mobil_responsable',TextType::class,array( 
                'label'=>'Téléphone mobile du responsable:',
                'attr' =>array('class'=>'form-control')
                ))
           /* ->add('prenom_responsable', TextType::class, array(
                'label'=> 'Prénom du responsable:',
                'attr' =>array('class'=>'form-control')
                ))*/
            ->add('emailResponsable',EmailType::class, array(
                'label'=>'Email du responsable:',
                'attr' =>array('class'=>'form-control')
                ) )          
           
            ->add('secteurActivite', ChoiceType::class, 
                       array('choices' => array_flip($libelleSecteur) 
                                              )  
                )           
             ->add('notificationCvPoste', ChoiceType::class, [
                    'choices'  => array(
                      'Oui'=>'Oui',
                      'Non'=>'Non'
                     ),
                    'multiple' => false,
                    'expanded' => true,
                    'label'   => 'Souhaitez-vous recevoir une notification à chaque nouvelle insertion d\'un CV ?'
                ])

            ->add('save', SubmitType::class, array(
                'label'=> 'Sauvegarder', 
                'attr' => [
                    'class' => 'btn btn-primary'
                    ]  ))

            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entreprise       = $form->getData();
            $name             = $form['nom_responsable']->getData();
            $emailResponsable = $form['emailResponsable']->getData();
            $idRole           = '11';
            $idUser           = $this->addUser($name,$emailResponsable,$idRole);
            $entreprise ->setIdRole($idRole);
            $entreprise ->setIdUser($idUser);
            $em = $this->getDoctrine()->getEntityManager();
            $em ->persist($entreprise);
            $em ->flush($entreprise);

            $this-> addFlash('message','L\' inscription a bien été enregistrée. Un email de confirmation contenant l\'identifiant et le mot de passe a été envoyé au client.');
            return $this->redirectToRoute('admin_entreprise_index');
        }
        return  $this->render('AdminBundle:OffreEmploi:create_entreprise.html.twig',array(
            'form' => $form->createView(),
        ));
    }


    /**
     * Matches /blog exactly
     *
     * @Route("/entreprise/secteur", name="admin_entreprise_secteur_index")
     */
    public function listeSecteurAction(){
        $em =  $this->getDoctrine()->getManager();
        $listSecteur = $em->getRepository('AdminBundle:epizy_secteur_activites')->findAll();
        return  $this->render('AdminBundle:OffreEmploi:liste_secteur.html.twig', array('listSecteur'=>$listSecteur));
    }

      /**
     * @Route("/entreprise/edit/{id}", name="admin_entreprise_edit")
     */
    public function updateAction(Request $request, $id){
        $em           = $this->getDoctrine()->getManager();
        $listeSecteur = new epizy_secteur_activites();
        $listeSecteur = $this->getDoctrine()->getManager()
                            ->getRepository('AdminBundle:epizy_secteur_activites')->findByEtat(1);
        $libelleSecteur = array();
                foreach ($listeSecteur as $secteur) {
                                 array_push($libelleSecteur,$secteur->getLibele());
                                }

        $entreprises = $em->getRepository('AdminBundle:epizy_entreprises')->find($id);
        $entreprises -> setNomEntreprise($entreprises->getNomEntreprise());
        $entreprises -> setAdressePhysique($entreprises->getAdressePhysique());
        $entreprises -> setNif($entreprises->getNif());
        $entreprises -> setStatistique($entreprises->getStatistique());
        $entreprises -> setTelFixeEntreprise($entreprises->getTelFixeEntreprise());
        $entreprises -> setTitre($entreprises->getTitre());
        $entreprises -> setNomResponsable($entreprises->getNomResponsable());
        $entreprises -> setPrenomResponsable($entreprises->getPrenomResponsable());
        $entreprises -> setTelMobilResponsable($entreprises->getTelMobilResponsable());
        $entreprises -> setEmailResponsable($entreprises->getEmailResponsable());
        $entreprises -> setSecteurActivite($entreprises->getSecteurActivite());
        $entreprises -> setNewsletter($entreprises->getNewsletter());
        $entreprises -> setNotificationCvPoste($entreprises->getNotificationCvPoste());
        $entreprises -> setIdRole($entreprises->getIdRole());
        $entreprises -> setIdUser($entreprises->getIdUser());        
        $entreprises -> setRegion($entreprises->getRegion());
        $entreprises -> setProduitVendu($entreprises->getProduitVendu());
        $entreprises -> setPhoto1($entreprises->getPhoto1());
        $entreprises -> setPhoto2($entreprises->getPhoto2());
        $entreprises -> setAutres($entreprises->getAutres());
        $entreprises -> setReference($entreprises->getReference());

         $form = $this->createFormBuilder($entreprises)
            ->add('nom_entreprise', TextType::class,array(
                'label'=> 'Nom de l\'entreprise:' ,
                'attr' =>array('class'=>'form-control')
                ))
            ->add('adresse_physique', TextType::class,array(
                'label'=> 'Adresse physique de l\'entreprise:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('nif',TextType::class, array(
                'label'=>'Nif:',
                'attr' =>array('class'=>'form-control')))
            ->add('statistique', TextType::class,array(
                'label'=> 'Numéro statistique:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('tel_fixe_entreprise', TextType::class,array(
                'label'=> 'Téléphone fixe de l\'entreprie:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('titre',ChoiceType::class ,
                array('choices' =>array(
                      'Mr'  =>'Mr',
                      'Mme' =>'Mme',
                      'Mlle'=> 'Mlle'  ),
                    'attr'=>array('class'=>'form-control')
                     )
                )
            ->add('nom_responsable', TextType::class,array(
                'label'=> 'Nom du responsable',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('emailResponsable',EmailType::class, array(
                'label'=>'Email du responsable:',
                'disabled' => true,
                'attr' =>array('class'=>'form-control')
                ) )
            ->add('tel_mobil_responsable',TextType::class,array( 
                'label'=>'Téléphone mobile du responsable:',
                'attr' =>array('class'=>'form-control')
                ))
           
            ->add('secteurActivite', ChoiceType::class, 
                       array('choices' => array_flip($libelleSecteur) 
                                              )  
                )
            ->add('newsletter', ChoiceType::class, [
                    'choices'  => array(
                      'Oui'=>'Oui',
                      'Non'=>'Non'
                     ),
                    'multiple' => false,
                    'expanded' => true,
                    'label'   => 'Voulez-vous recevoir nos nouvelles du mois'
            ])           
             ->add('notificationCvPoste', ChoiceType::class, [
                    'choices'  => array(
                      'Oui'=>'Oui',
                      'Non'=>'Non'
                     ),
                    'multiple' => false,
                    'expanded' => true,
                    'label'   => 'Notification quand un nouveau CV est insérer'
                ])

            ->add('save', SubmitType::class, array(
                'label'=> 'Sauvegarder', 
                'attr' => [
                    'class' => 'btn btn-primary'
                    ]  ))

            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entreprise = $form->getData();
            $name       = $form['nom_responsable']->getData(); 
            $idUser     = $entreprises->getIdUser();

            $this->updateUser($name,$idUser);

            $em ->persist($entreprise);
            $em ->flush($entreprise);

            $this-> addFlash('message','Mise à jour entreprise  a été bien enregistré');
            return $this->redirectToRoute('admin_entreprise_index');
        }

         return $this->render('AdminBundle:OffreEmploi:edit_entreprise.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }

    
      /**
     * @Route("/entreprise/detail/{id}", name="admin_entreprise_detail")
     */
    public function  detailEntrepriseAction($id){
        $em         = $this->getDoctrine()->getManager();
        $entreprises = $em->getRepository('AdminBundle:epizy_entreprises')->find($id);

        return $this->render('AdminBundle:OffreEmploi:detail_entreprise.html.twig', array('entreprises'=>$entreprises));
    }

     /**
     * @Route("/entreprise/changestatus/{id}", name="admin_entreprise_change_status")
     */
    public function ChangeStatus($id){
        $em = $this->getDoctrine()->getManager();
        $user_modifier = $em->getRepository('AppBundle:epizy_users')->find($id);
        $user_modifier->setStatus($user_modifier->getStatus() == 0 ? 1 : 0);
        $em->flush($user_modifier);
        return $this->redirectToRoute('admin_entreprise_index');

    }

     /**
     * @Route("/entreprise/delete/{id}", name="admin_entreprise_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entreprise_a_sup = $em->getRepository('AdminBundle:epizy_entreprises')->find($id);
        $id_user = $entreprise_a_sup->getIdUser();
        $user_correspondant = $em->getRepository('AppBundle:epizy_users')->find($id_user);
        $em->remove($entreprise_a_sup);
        $em->remove($user_correspondant);
        $em->flush();
        
        $this->addFlash('message', 'L\'entreprise est supprimée');
       
        return $this->redirectToRoute('admin_entreprise_index');
        
        
    }

    // find secteur
    public function findByEtat($etat){
        $qb = $this->createQueryBuilder('s');
        $qb ->where('s.etat = :etat')
            ->setParamater('etat', $etat);

        return $qb ->getQuery()
                   ->getResult();
    }


    public function addUser($name,$emailResponsable,$idRole) {
        $users   = new epizy_users(); 
        $str = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';
        $passWord = str_shuffle($str);

        $passWord = substr($passWord,1,6); // $passWord visible par l'entreprise   
       
        $pass = password_hash($passWord, PASSWORD_BCRYPT);
        $users -> setName($name);
        $users -> setSeoname(strtolower($name));
        $users -> setEmail($emailResponsable);
        $users -> setPassword($pass);
        $users -> setMdpChange('0');
        $users -> setStatus('1');
        $users -> setCreated(new \Datetime());
        $users -> setDescription('null');
        $users -> setSubscriber('1');
        $users -> setHasImage('0');
        $users -> setFailedAttempts('0');
        $users -> setIdRole($idRole);
       
        $em = $this->getDoctrine()->getEntityManager();
        $em -> persist($users);
        $em -> flush($users);

        return $users->getId();
    }

    public function updateUser($name,$idUser) {
        $em    = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:epizy_users')->find($idUser);

        $users -> setName($name);
              
        $em -> persist($users);
        $em -> flush($users);
    }
 

     /**
     * @Route("/entreprise/search", name="admin_entreprise_search")
     */
    /*
    public function searchAction(Request $request){
        $entreprise = new epizy_entreprises();

        $form_search = $this->createFormBuilder()
            ->add('nom_entreprise', SearchType::class,array(
                'label'=> 'Nom de l\'entreprise:' ,
                'attr' =>array('class'=>'form-control')
                ))
            ->add('save', SubmitType::class, array(
                'label'=> 'Chercher', 
                'attr' => [
                    'class' => 'btn btn-primary'
                    ]  ))

            ->getForm();

        $form_search->handleRequest($request);
        if ($form_search->isSubmitted() && $form_search->isValid())
        {
           

            return $this->redirectToRoute('admin_entreprise_index');
        }

      return  $this->render('AdminBundle:OffreEmploi:liste_entreprise.html.twig',array(
            'form_search' => $form_search->createView()  ));
    }
    */
    


}
       