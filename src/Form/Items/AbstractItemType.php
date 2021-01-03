<?php

namespace App\Form\Items;

use App\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbstractItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'items.form.name.label',
                'attr' => [
                    'placeholder' => 'items.form.name.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'items.form.description.label',
                'row_attr' => [
                    'class' => 'col-sm-12 tynimce-editor'
                ],
            ])
            ->add('slug', TextType::class, [
                'required' => true,
                'label' => 'items.form.slug.label',
                'attr' => [
                    'placeholder' => 'items.form.slug.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'help' => 'form.slug.help',
                'help_attr' => [
                    'class' => 'generate-slug btn btn-default'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
