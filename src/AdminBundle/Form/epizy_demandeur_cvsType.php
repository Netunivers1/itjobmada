<?php

namespace AdminBundle\Form;

use AdminBundle\Entity\epizy_demandeur_emplois;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class epizy_demandeur_cvsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', CheckboxType::class,
                array('required'=>false, 'empty_data'=>true)
            )
            ->add('statu', HiddenType::class)
            ->add('reference', HiddenType::class)
            ->add('permis',ChoiceType::class,
                array(
                    'choices'=>array(
                        'A' => 'A',
                        'A\'' => 'A\'',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'Aucun' => 'Aucun'
                    ),
                    'choices_as_values' => true,'multiple'=>true,'expanded'=>true,
                    'mapped' =>false
                )
            )
            ->add('emploiRechercheId', EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_emploi_recherches',
                    'choice_label'=>'libele',
                    'attr'=>['class'=>'form-control']
                )
            )
            ->add('emploiRecherche',TextType::class,array('required'=>false,'attr'=>['class'=>'form-control']) )
            ->add('logiciel', TextType::class,array('required'=>false,'attr'=>['class'=>'form-control']))
            ->add('logicielId',EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_logiciels',
                    'choice_label'=>'libele',
                    'required'=>false,
                    'empty_data'=>null,
                    'multiple'=>false,
                    'expanded'=>false,
                    'placeholder'=> false,
                    'attr'=>['class'=>'form-control']
                )
            )
            ->add('langue' , TextType::class,array('required'=>false,'attr'=>['class'=>'form-control']))
            ->add('langueId',EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_langues',
                    'choice_label'=>'nom',
//                    'multiple'=>true,
                    'required'=>false,
                    'placeholder'=> false,
                    'attr'=>['class'=>'form-control']

                )
            )
//            ->add('statu')
//            ->add('reference')
            ->add('centreInteretCertificat', TextType::class, array('required'=>false, 'attr'=>['class'=>'form-control']))
            ->add('centreInteretProjet', TextType::class, array('required'=>false, 'attr'=>['class'=>'form-control']));
//            ->add('dateCreation')
//            ->add('datePublished')
//            ->add('nbrVue')
//            ->add('position')        ;

        $builder
            ->add('formations', CollectionType::class,
                array(
                    'entry_type' => epizy_demandeur_formationsType::class,
                    'mapped'     => true,
                    'allow_add'  => true,
                    'allow_delete'=> true,
                    'prototype'  => true,
                    'attr'       => ['class'=>'form_formation'],
                    'by_reference'=>false,
                    'label'      =>true
                )
            )->add('experiences', CollectionType::class,
                array(
                    'entry_type' => epizy_demandeur_experienceType::class,
                    'mapped'     => true,
                    'allow_add'  => true,
                    'allow_delete'=> true,
                    'prototype'  => true,
                    'attr'       => ['class'=>'form_experience'],
                    'by_reference'=>false
                )
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\epizy_demandeur_cvs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_epizy_demandeur_cvs';
    }


}
