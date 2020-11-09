<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',EmailType::class, array(
                'required' => true,
                'attr' => array(
                    'placeholder' => 'users.form.username.placeholder'
                ),
                'row_attr' => array(
                    'class' => 'col-12'
                ),
                'label' => 'form.labels.username'
            ))
            ->add('password',PasswordType::class, array(
                'required' => true,
                'row_attr' => array(
                    'class' => 'col-12 col-sm-6'
                ),
                'label' => 'users.form.password.label'
            ))
            ->add('confirmPassword',PasswordType::class, array(
                'required' => true,
                'row_attr' => array(
                    'class' => 'col-12 col-sm-6'
                ),
                'label' => 'users.form.confirm_password.label'
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'form.button.signup',
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
            'data_class' => User::class,
        ]);
    }
}
