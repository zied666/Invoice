<?php

namespace FactureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnteteType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('reference')
                ->add('dateCreation')
                ->add('client', 'hidden')
                ->add('nomClient')
                ->add('adresseClient')
                ->add('matriculeFiscale')
                ->add('tel')
                ->add('email')
                ->add('mntFraisTaxable')
                ->add('mntFraisNonTaxable')
                ->add('totalTva')
                ->add('timbre')
                ->add('totalRemise')
                ->add('fraisDossier')
                ->add('etat')
                ->add('note')
                ->add('suiviPar')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FactureBundle\Entity\Entete'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'facturebundle_entete';
    }

}
