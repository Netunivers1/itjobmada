<?php

namespace AdminBundle\Form;

use AdminBundle\Controller\DemandeurController;
use AdminBundle\Entity\epizy_demandeur_emplois;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class epizy_demandeur_emploisType extends AbstractType
{
    private $ville ;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $emploi_trouve = new epizy_demandeur_emplois();
        $builder
            ->add('audition', ChoiceType::class,
                array(
                    'choices'=>array(
                        'oui'=>1,
                        'non car il refuse l\'entretien'=>2,
                        'non car il vit en province'=>3,
                        'Pas encore'=>4
                    ),
                    'attr'=>['class'=>'form-control']
                )
            )
            ->add('emploiTrouve', ChoiceType::class,
                array(
                    'choices'=>array(
                        'grâce à Itjobmada'=>1,
                        'a trouvé du travail via un autre canal'=>2,
                        'non il est encore à la recherche d’un emploi '=>3
                    ),
                    'attr'=>['class'=>'form-control']
                )
            )
            ->add('titre', ChoiceType::class,
                array(
                    'choices'=>array(
                        'Monsieur'=> 'Mr',
                        'Madame'=>'Mme'
                    ),
                    'attr'=>['class'=>'form-control']
                )
            )
            ->add('nom', TextType::class, array('required'=>true, 'attr'=>['class'=>'form-control']))
            ->add('prenom', TextType::class, array('required'=>true, 'attr'=>['class'=>'form-control']))
            ->add('email', EmailType::class, array('required'=>true, 'attr'=>['class'=>'form-control']))
            ->add('adresse', TextType::class, array('required'=>true, 'attr'=>['class'=>'form-control']))
            ->add('ville', TextType::class,array('required'=>false, 'attr'=>['class'=>'form-control ville']) )
            ->add('villeId', EntityType::class,
                array(
                    'class'=> 'AdminBundle:epizy_villes',
                    'choice_label'=>'libele',
                    'attr'=>['class'=>'form-control']
                )
            )
            ->add('region', ChoiceType::class,
                array(
                    'choices'=>array(
                    'Analamanga','Alaotra-Mangoro',"Amoron'i Mania",'Analanjirofo','Androy','Anôsy','Atsimo-Andrefana',
                    'Atsimo-Atsinanana','Atsinanana','Boeny','Bongolava','Betsiboka','Diana','Haute Matsiatra','Ihorombe',
                    'Itasy','Melaky','Menabe','Sava','Sofia','Vakinankaratra','Vatovavy-Fitovinany'
                ),
                'choice_label'=>function($value){
                       if ($value){
                           return $value;
                       }
                },
                'attr'=>['class'=>'form-control listSearch'])
            )
            ->add('telephone', CollectionType::class,
                array(
                    'entry_type'    =>TextType::class,
                    'allow_add'     =>true,
                    'allow_delete'  =>true,
                    'required'      =>true,
                    'prototype'     =>true,
                    'attr'          =>['class'=>'telephone'],
                    'by_reference'  =>false,
                    'label'         =>true
                )
            )
            ->add('dateDeNaissance', BirthdayType::class,array('required'=>false, 'attr'=>['class'=>'form-control']) )
            ->add('choixEmploi', EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_emploi_recherches',
                    'choice_label'=>'libele',
                    'choice_value'=>'libele',
                    'required'=>false,
                    'placeholder'=>'Toutes les offres d\' emploi',
                    'attr'=>['class'=>'form-control listSearch']
                )
            )
            ->add('new_choixEmploi',TextType::class, array('required'=>false, 'mapped'=>false, 'attr'=>['class'=>'form-control']))
            ->add('new_choixFormation',TextType::class,array('required'=>false, 'attr'=>['class'=>'form-control']))
            ->add('choixFormation',EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_demandeur_emplois',
                    'choice_label'=>'ChoixFormation',
                    'choice_value'=>'ChoixFormation',
                    'required'=>false,
                    'placeholder'=>'Toutes les Formations',
                    'empty_data'=>'',
                    'attr'=>['class'=>'form-control listSearch']
                )
            )
            ->add('notificationEmploiPoste', ChoiceType::class,
                array(
                    'choices'=>array(
                        ' Oui' => 'oui',
                        ' Non' => 'non'
                    ),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true
                )
            )
            ->add('notificationFormationPoste', ChoiceType::class,
                array(
                    'choices'=>array(
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true
                )
            )
            ->add('photo', FileType::class, array('required'=>false, 'mapped'=>false,'attr'=>['class'=>'form-control'] ) )
            ->add('status', ChoiceType::class,
                array(
                    'choices'=>array(
                        'je cherche un emploi' => 1,
                        'je souhaite entretenir mon réseau' => 2,
                        'je cherche un stage' => 3
                    ),
                    'attr'=>['class'=>'form-control ']
                )
            )
            ->add('newsletter', ChoiceType::class,
                array(
                    'choices'=>array(
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true,
                    'attr'=>['class'=>'']
                )
            )
        ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\epizy_demandeur_emplois'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_epizy_demandeur_emplois';
    }

}
