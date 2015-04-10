<?php

namespace FactureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit')
            ->add('designation')
            ->add('tauxTva')
            ->add('quantite')
            ->add('nbrAdulte')
            ->add('puhtAdulte')
            ->add('puttAdulte')
            ->add('nbrEnfant')
            ->add('puhtEnfant')
            ->add('puttEnfant')
            ->add('mntTva')
            ->add('montantTaxable')
            ->add('montantNonTaxable')
            ->add('montantRemise')
            ->add('fraisDossier')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FactureBundle\Entity\Ligne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'facturebundle_ligne';
    }
}
