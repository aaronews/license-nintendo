<?php

namespace App\Form\Search;

use App\Entity\Search\AbstractSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AbstractSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /*  ->add('orderWay', ChoiceType::class,array(
                'required' => false,
                'label' => 'form.order_way.label',
                'placeholder' => false,
                'choices' => array(
                    'form.sorting.ASC' => 'ASC',
                    'form.sorting.DESC' => 'DESC',
                ),
                'data' => 'ASC',
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
            )) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AbstractSearch::class,
        ]);
    }
}
