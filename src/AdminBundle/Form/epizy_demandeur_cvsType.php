<?php

namespace AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('emploiRecherche')
            ->add('logiciel')
            ->add('langue')
            ->add('statu')
            ->add('reference')
            ->add('centreInteretCertificat')
            ->add('centreInteretProjet');
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
