<?php

namespace AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('position', CheckboxType::class, array('required'=>false))
            ->add('permis',ChoiceType::class,
                array(
                    'choices'=>array(
                        'A' => 'A',
                        'A\'' => 'A\'',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'Aucun' => 'Aucun`'
                    ),
                    'choices_as_values' => true,'multiple'=>true,'expanded'=>true
                )
            )
            ->add('emploiRechercheId', EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_emploi_recherches',
                    'choice_label'=>'libele'
                )
            )
            ->add('emploiRecherche',TextType::class,array('required'=>false) )
            ->add('logiciel', TextType::class,array('required'=>false))
            ->add('logicielId',EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_logiciels',
                    'choice_label'=>'libele',
                    'required'=>false,
                    'empty_data'=>null,
                    'multiple'=>false,
                    'expanded'=>false,
                    'placeholder'=> false
                )
            )
            ->add('langue' , TextType::class,array('required'=>false))
            ->add('langueId',EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_langues',
                    'choice_label'=>'nom',
//                    'multiple'=>true,
                    'required'=>false,
                    'placeholder'=> false

                )
            )
            ->add('statu')
            ->add('reference')
            ->add('centreInteretCertificat', TextType::class, array('required'=>false))
            ->add('centreInteretProjet', TextType::class, array('required'=>false));
//            ->add('dateCreation')
//            ->add('datePublished')
//            ->add('nbrVue')
//            ->add('position')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\epizy_demandeur_cvs',
            'mapped'=>false
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
