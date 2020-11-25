<?php

namespace App\Form\Licenses;

use App\Entity\License;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditLicenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uploadThumbnail', FileType::class, array(
                'required' => false,
                'label' => 'licenses.form.thumbnail.label',
                'row_attr' => array(
                    'class' => 'col-sm-6 col-12'
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'form.button.edit',
                'row_attr' => array(
                    'class' => 'col-sm-12 text-center mt-3 '
                ),
                'attr' => array(
                    'class' => 'btn-lg btn btn-primary',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => License::class,
        ]);
    }

    public function getParent()
    {
        return AbstractLicenseType::class;
    }
}
