<?php

namespace GameBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InfantryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('atk', IntegerType::class, array('label' => 'Attaque'))
            ->add('defense')
            ->add('time', IntegerType::class, array('label' => 'Temps de formation en mn'))
            ->add('buildingType', EntityType::class, array(
                'class' => 'GameBundle:BuildingType',
                'choice_label' => 'name',
                'label' => 'Batiment de formation'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GameBundle\Entity\Infantry'
        ));
    }
}
