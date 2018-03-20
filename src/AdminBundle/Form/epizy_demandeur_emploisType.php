<?php

namespace AdminBundle\Form;

use AdminBundle\Controller\Demandeurcontroller;
use AdminBundle\Entity\epizy_villes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class epizy_demandeur_emploisType extends AbstractType
{
    private $ville ;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('audition', CheckboxType::class, array('required'=>false))
            ->add('emploiTrouve', ChoiceType::class,
                array(
                    'choices'=>array(
                        'grâce à Itjobmada'=>1,
                        'a trouvé du travail via un autre canal'=>2,
                        'non il est encore à la recherche d’un emploi '=>3
                    )
                )
            )
            ->add('titre', ChoiceType::class,
                array(
                    'choices'=>array(
                        'Monsieur'=> 'Mr',
                        'Madame'=>'Mme'
                    )
                )
            )
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('adresse')
            ->add('ville')
            ->add('region')
            ->add('telephone')
            ->add('dateDeNaissance')
            ->add('choixEmploi')
            ->add('choixFormation')
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
            ->add('photo', FileType::class, array('required'=>false))
            ->add('status', ChoiceType::class,
                array(
                    'choices'=>array(
                        'je cherche un emploi' => 1,
                        'je souhaite entretenir mon réseau' => 2,
                        'je cherche un stage' => 3
                    )
                )
            )
            ->add('newsletter', ChoiceType::class,
                array(
                    'choices'=>array(
                        'Oui' => 'oui',
                        'Non' => 'non'
                    ),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true
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
            'data_class' => 'AdminBundle\Entity\epizy_demandeur_emplois',
            'mapped'=>false
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
