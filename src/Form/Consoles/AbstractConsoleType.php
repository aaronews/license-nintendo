<?php

namespace App\Form\Consoles;

use App\Entity\Console;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbstractConsoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => true,
                'label' => 'consoles.form.name.label',
                'attr' => array(
                    'placeholder' => 'consoles.form.name.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
            ))
            ->add('description', TextareaType::class, array(
                'required' => true,
                'label' => 'consoles.form.description.label',
                'row_attr' => array(
                    'class' => 'col-sm-12 tynimce-editor'
                ),
            ))
            ->add('slug', TextType::class, array(
                'required' => true,
                'label' => 'consoles.form.slug.label',
                'attr' => array(
                    'placeholder' => 'consoles.form.slug.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
                'help' => 'form.slug.help',
                'help_attr' => array(
                    'class' => 'generate-slug btn btn-default'
                )
            ))
            ->add('releasePrice', IntegerType::class, array(
                'required' => true,
                'label' => 'consoles.form.release_price.label',
                'attr' => array(
                    'placeholder' => 'consoles.form.release_price.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
            ))
            ->add('releaseDate', DateType::class, array(
                'required' => true,
                'label' => 'consoles.form.release_date.label',
                'attr' => array(
                    'placeholder' => 'consoles.form.release_date.placeholder',
                    'class' => 'datepicker',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
                'widget' => 'single_text',
                 'format' => 'dd/MM/yyyy', 
                'html5' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Console::class,
        ]);
    }
}
