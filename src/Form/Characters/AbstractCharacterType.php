<?php

namespace App\Form\Characters;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbstractCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => true,
                'label' => 'characters.form.name.label',
                'attr' => array(
                    'placeholder' => 'characters.form.name.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-4'
                ),
            ))
            ->add('description', TextareaType::class, array(
                'required' => true,
                'label' => 'characters.form.description.label',
                'row_attr' => array(
                    'class' => 'col-sm-12 tynimce-editor'
                ),
            ))
            ->add('slug', TextType::class, array(
                'required' => true,
                'label' => 'characters.form.slug.label',
                'attr' => array(
                    'placeholder' => 'characters.form.slug.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-4'
                ),
                'help' => 'form.slug.help',
                'help_attr' => array(
                    'class' => 'generate-slug btn btn-default'
                )
            ))
            ->add('gender', ChoiceType::class, array(
                'required' => true,
                'label' => 'characters.form.gender.label',
                'placeholder' => 'characters.form.gender.placeholder',
                'choices' => array(
                    'characters.form.gender.options.M' => 'M',
                    'characters.form.gender.options.F' => 'F',
                    'characters.form.gender.options.Neutre' => 'N',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-4'
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
