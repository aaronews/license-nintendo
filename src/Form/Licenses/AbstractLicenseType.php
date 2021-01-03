<?php

namespace App\Form\Licenses;

use App\Entity\License;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbstractLicenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'licenses.form.name.label',
                'attr' => [
                    'placeholder' => 'licenses.form.name.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'licenses.form.description.label',
                'row_attr' => [
                    'class' => 'col-sm-12 tynimce-editor'
                ],
            ])
            ->add('slug', TextType::class, [
                'required' => true,
                'label' => 'licenses.form.slug.label',
                'attr' => [
                    'placeholder' => 'licenses.form.slug.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'help' => 'form.slug.help',
                'help_attr' => [
                    'class' => 'generate-slug btn btn-default'
                ]
            ])
            ->add('uploadLogo', FileType::class, [
                'required' => false,
                'label' => 'licenses.form.logo.label',
                'row_attr' => [
                    'class' => 'col-sm-6 col-12'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => License::class,
        ]);
    }
}
