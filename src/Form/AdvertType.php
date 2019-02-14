<?php

namespace App\Form;

use App\Entity\Advert;
use App\Form\ImageType;
use App\Form\SkillType;
use App\Form\AdvertSkillType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title')
            ->add('author')
            ->add('content')
            ->add('published')
            ->add('image', ImageType::class)
            ->add('skills', CollectionType::class, [
                'entry_type' => AdvertSkillType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('save', SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
            'attr' => [ 'novalidate' => 'novalidate' ]
        ]);
    }
}
