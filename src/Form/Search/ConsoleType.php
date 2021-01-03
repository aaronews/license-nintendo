<?php

namespace App\Form\Search;

use App\Entity\Game;
use App\Entity\Search\Console;
use App\Repository\GameRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ConsoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => false,
                'label' => 'consoles.form.name.label',
                'attr' => [
                    'placeholder' => 'consoles.form.name.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('releaseDateMin', DateType::class, [
                'required' => false,
                'label' => 'consoles.form.release_date_min.label',
                'attr' => [
                    'placeholder' => 'consoles.form.release_date_min.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
            ->add('releaseDateMax', DateType::class, [
                'required' => false,
                'label' => 'consoles.form.release_date_max.label',
                'attr' => [
                    'placeholder' => 'consoles.form.release_date_max.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
            ->add('releasePriceMin', IntegerType::class, [
                'required' => false,
                'label' => 'consoles.form.release_price_min.label',
                'attr' => [
                    'placeholder' => 'consoles.form.release_price_min.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('releasePriceMax', IntegerType::class, [
                'required' => false,
                'label' => 'consoles.form.release_price_max.label',
                'attr' => [
                    'placeholder' => 'consoles.form.release_price_max.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('game', EntityType::class, [
                'required' => false,
                'label' => 'consoles.form.game.label',
                'placeholder' => 'consoles.form.game.placeholder',
                'class' => Game::class,
                'choice_label' => 'name',
                'query_builder' => function(GameRepository $gameRepository){
                    return $gameRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-6',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.button.filter',
                'attr' => [
                    'class' => 'btn-lg btn-primary btn',
                ],
                'row_attr' => [
                    'class' => 'col-sm-12 text-center'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Console::class,
        ]);
    }
}
