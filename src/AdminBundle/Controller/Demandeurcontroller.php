<?php

namespace AdminBundle\Controller;


use AdminBundle\Entity\epizy_demandeur_emplois;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class Demandeurcontroller extends Controller
{
    /**
     * @Route("/demandeur/index", name="admin_demandeur_index")
     */
    public function indexAction(){

        $formview = $this->createCv() ;
        return $this->render('AdminBundle:Demandeur:index.html.twig', array('form'=>$formview->createView() )) ;
    }

    public function createCv(){
        $dmd_emplois = new epizy_demandeur_emplois();
        $form        = $this->createFormBuilder($dmd_emplois) ;
        $form
            ->add('audition', ChoiceType::class,
                array(
                    'choices'  => array(
                        'Oui' => 1,
                        'Non car il refuse l’entretien' => 3,
                        'Non car il vit en province' => 4,
                        'Pas encore'=> 2
                    ),
                    'label'=>'Ce candidat a-t-il été auditionné',
                    'attr' => array('class'=>'form-control')
                )
            )
            ->add('emploi_trouve', ChoiceType::class,
                array(
                    'choices'  => array(
                        'Grâce à Itjobmada' =>1,
                        'a trouvé du travail via un autre canal' => 2,
                        'non il est encore à la recherche d’un emploi' => 3
                    ),
                    'label'=>'Ce candidat a trouvé un emploi',
                    'attr' => array('class'=>'form-control')
                )
            )
//            ->add('imgupload', HiddenType::class)
//            ->add('photoupload', FileType::class, array('attr'=>array('class'=>'form-control')))
            ->add('titre', ChoiceType::class,
                array(
                    'choices'  => array(
                        'Monsieur' => 'Mr',
                        'Madame' => 'Mme'
                    ),
                    'label'=>'Ce candidat a trouvé un emploi',
                    'attr' => array('class'=>'form-control')
                )
            )
            ->add('nom', TextType::class, array('label'=>'Nom:','attr'=>array('class'=>'form-control') ) )
            ->add('prenom', TextType::class, array('label'=>'Prénom:','attr'=>array('class'=>'form-control') ))
            ->add('adresse', TextType::class, array('label'=>'Adresse:','attr'=>array('class'=>'form-control') ))
            ->add('ville', TextType::class, array('label'=>'Ville:','attr'=>array('class'=>'form-control') ))
            ->add('region', ChoiceType::class,
                array(
                    'choices'  => array(

                    ),
                    'label'=>'Région',
                    'attr' => array('class'=>'form-control')
                )
            )
            ->add('telephone', TextType::class, array('label'=>'Telephone:','attr'=>array('class'=>'form-control') ))
            ->add('date_de_naissance', DateTimeType::class, array('label'=>'Date de naissance:','attr'=>array('class'=>'form-control') ))
//            ->add('statut', ChoiceType::class,
//                array(
//                    'choices'  => array(
//                        'Je cherche un stage' => 1,
//                        'je souhaite entretenir mon réseau' => 2,
//                        'je cherche un stage' => 3,
//                    ),
//                    'label'=>'Statut',
//                    'attr' => array('class'=>'form-control')
//                )
//            )
            //->add('permis', CheckboxType::class, array('label'=>'Nom:','attr'=>array('class'=>'form-control') ))
            ->add('prenom', TextType::class, array('label'=>'Nom:','attr'=>array('class'=>'form-control') ))
            ->add('prenom', TextType::class, array('label'=>'Nom:','attr'=>array('class'=>'form-control') ))
            ->add('prenom', TextType::class, array('label'=>'Nom:','attr'=>array('class'=>'form-control') ))
        ;
        $formview    = $form->getForm();
        return $formview ;
    }
}