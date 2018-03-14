<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class epizy_entreprisesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idUser')->add('idRole')->add('nomEntreprise')->add('adressePhysique')->add('nif')->add('statistique')->add('telFixeEntreprise')->add('titre')->add('nomResponsable')->add('prenomResponsable')->add('emailResponsable')->add('telMobilResponsable')->add('secteurActivite')->add('newsletter')->add('notificationCvPoste')->add('notificationDatelimiteOffre')->add('voeux')->add('region')->add('produitVendu')->add('photo1')->add('photo2')->add('autres')->add('reference')->add('dateAjout')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\epizy_entreprises'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_epizy_entreprises';
    }


}
