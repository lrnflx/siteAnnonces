<?php

namespace App\Form;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Form\AdvertType;
use App\Entity\AdvertSkill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdvertSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skill', EntityType::class, [
                'class'         => Skill::class,
                'choice_label'  => 'name',
                'multiple' => false,
                'expanded' => false
            
            ])
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'expert' => 'expert',
                    'confirmé' => 'confirmé',
                    'débutant' => 'débutant'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdvertSkill::class,
        ]);
    }
}
