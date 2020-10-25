<?php

namespace App\Form\Licenses;

use App\Entity\License;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbstractLicenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => true,
                'label' => 'licenses.form.name.label',
                'attr' => array(
                    'placeholder' => 'licenses.form.name.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
            ))
            ->add('description', TextareaType::class, array(
                'required' => true,
                'label' => 'licenses.form.description.label',
                'row_attr' => array(
                    'class' => 'col-sm-12 tynimce-editor'
                ),
            ))
            ->add('slug', TextType::class, array(
                'required' => true,
                'label' => 'licenses.form.slug.label',
                'attr' => array(
                    'placeholder' => 'licenses.form.slug.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
                'help' => 'form.slug.help',
                'help_attr' => array(
                    'class' => 'generate-slug btn btn-default'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => License::class,
        ]);
    }
}
