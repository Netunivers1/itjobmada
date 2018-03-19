<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Epizy_ecole;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpizyecoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom')
                ->add('adress')
                ->add('bp')
                ->add('email')
                ->add('region')
                ->add('tel')
                ->add('nom_resp')
                ->add('diplReconnu')
                ->add('photo')
                ->add('site')
                ->add('lienfb')
                ->add('status', HiddenType::class, array('attr' => ['value' => '0']))
                ->add('nbrvue', HiddenType::class, array('attr' => ['value' => '0']))
                ->add('created', HiddenType::class, array('attr' => ['value' => "now"]))
                ->add('Enregistrer', SubmitType::class)
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Epizy_ecole::class,
        ));
    }
}