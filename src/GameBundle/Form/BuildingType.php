<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GameBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use GameBundle\Form\BuildingRessourceType;
use GameBundle\Entity\BuildingRessource;

class BuildingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('buildingType', EntityType::class, array(
                'class' => 'GameBundle:BuildingType',
                'choice_label' => 'name',
                'label' => 'Type de batiment'
            ))
            ->add('lvl', IntegerType::class, array('label' => 'Lvl'))
            ->add('time', IntegerType::class, array('label' => 'Temps de construction (en mn)'))

            ->add('add', IntegerType::class, array('required' => false,
                                                    'label' => 'Ajout suivant le type de bat'))
            ->add('addHabitant', IntegerType::class, array('label' => 'Ajout d\'habitant'))
            ->add('addPoint', IntegerType::class, array('label' => 'Ajout de point'))
           /* ->add('ressources', EntityType::class, array(
                'class' => 'GameBundle:Ressource',
                'choice_label' => 'name'
            ))*/
            /*->add('ressources', CollectionType::class, array(
                    'entry_type' => BuildingRessourceType::class
               )
           )*/
            /*->add('required', EntityType::class, array(
                'class' => 'GameBundle:BuildingType',
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
                'label' => 'Batiment requis'
                )) */
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GameBundle\Entity\Building'
        ));
    }
}
