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
            ->add('moisDebut')
            ->add('moisFin')
            ->add('annee')
            ->add('ville')
            ->add('pays')
            ->add('nomEntreprise')
            ->add('secteurActiviteId', EntityType::class,
                array(
                    'class'=>'AdminBundle:epizy_secteur_activites',
                    'choice_label'=>'libele',
                ))
            ->add('posteOccupe')
            ->add('missionTache',TextareaType::class,array('required'=>false))
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
