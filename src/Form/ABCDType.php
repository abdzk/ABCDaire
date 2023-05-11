<?php

namespace App\Form;

use App\Entity\ABCD;
use App\Entity\Categories;
use App\Entity\Letters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ABCDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('letters', EntityType::class, [
                'label' => 'Lettres',
                'class' => Letters::class,
                'choice_label' => 'name',
                'multiple' => true,

            ])
            ->add('categories',EntityType::class, [
                'label' => 'Categories',
                'class' => Categories::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('name')
            ->add('description')
            ->add('img')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ABCD::class,
        ]);
    }
}
