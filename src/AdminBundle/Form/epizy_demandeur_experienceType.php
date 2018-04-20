<?php

namespace AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class epizy_demandeur_experienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('moisDebut', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('moisFin', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('annee', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('ville', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('pays', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('nomEntreprise', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('secteuractivite_id', EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_secteur_activites',
                    'choice_label'=>'libele',
                    'choice_value'=>'libele',
                    'attr'=>['class'=>'form-control']
                ))
            ->add('posteOccupe', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('missionTache',TextareaType::class,array('required'=>false, 'attr'=>['class'=>'form-control']))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\epizy_demandeur_experience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_epizy_demandeur_experience';
    }


}
