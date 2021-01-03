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
            ->add('username',EmailType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'users.form.username.placeholder'
                ],
                'row_attr' => [
                    'class' => 'col-12'
                ],
                'label' => 'form.labels.username'
            ])
            ->add('password',PasswordType::class, [
                'required' => true,
                'row_attr' => [
                    'class' => 'col-12 col-sm-6'
                ],
                'label' => 'users.form.password.label'
            ])
            ->add('confirmPassword',PasswordType::class, [
                'required' => true,
                'row_attr' => [
                    'class' => 'col-12 col-sm-6'
                ],
                'label' => 'users.form.confirm_password.label'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.button.signup',
                'row_attr' => [
                    'class' => 'col-sm-12 text-center mt-3 '
                ],
                'attr' => [
                    'class' => 'btn-lg btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
