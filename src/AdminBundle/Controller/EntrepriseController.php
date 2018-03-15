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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
        $entreprise = new epizy_entreprises();
        $em = $this->getDoctrine()->getManager();
        $listEntreprise= $em->getRepository('AdminBundle:epizy_entreprises')->findAll();
        return $this->render('AdminBundle:OffreEmploi:liste_entreprise.html.twig', array('listEntreprise'=>$listEntreprise));
    }
    /**
     * Matches /blog exactly
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
                    'attr'=>array('class'=>'form-control')
                     )
                )
            ->add('nom_responsable', TextType::class,array(
                'label'=> 'Nom du responsable',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('prenom_responsable', TextType::class, array(
                'label'=> 'Prénom du responsable:',
                'attr' =>array('class'=>'form-control')
                ))
            ->add('emailResponsable',EmailType::class, array(
                'label'=>'Email du responsable:',
                'attr' =>array('class'=>'form-control')
                ) )
            ->add('tel_mobil_responsable',TextType::class,array( 
                'label'=>'Téléphone mobile du responsable:',
                'attr' =>array('class'=>'form-control')
                ))
           
            ->add('secteurActivite', ChoiceType::class, 
                       array('choices' => $libelleSecteur                        )  
                )
           /*
            ->add('secteurActivite', EntityType::class, array(
                'class' => 'AdminBundle:epizy_secteur_activites',
                 'query_builder' => function (entityRepository $er) {
                 return $er->createQueryBuilder('s')
                            ->select('s.libele')
                            ->where('s.etat = :etat')
                            ->setParamater('etat', 1);
                 },
                 'choice_label' => 'Secteur d\' activité' ,
                ));
                */
            ->add('notificationCvPoste',ChoiceType::class ,
                array(
                    'label'   => 'Souhaitez-vous recevoir une notification à chaque nouvelle insertion d\'un CV ?',
                    'attr'    =>array('class'=>'form-control'),
                    'choices' =>array(
                      'Oui'=>'Oui',
                      'Non'=>'Non'
                     ),
                ) )

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

    // find secteur
    public function findByEtat($etat){
        $qb = $this->createQueryBuilder('s');
        $qb ->where('s.etat = :etat')
            ->setParamater('etat', $etat);

        return $qb ->getQuery()
                   ->getResult();
    }

    public function updateAction(){
        
    }


    public function addUser($name,$emailResponsable,$idRole)
    {
        $users= new epizy_users(); 
        $users -> setName($name);
        $users -> setSeoname(strtolower($name));
        $users -> setEmail($emailResponsable);
        $users -> setPassword('pass');
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


}