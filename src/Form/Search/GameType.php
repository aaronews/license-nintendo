<?php

namespace App\Form\Search;

use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use App\Entity\Search\Game;
use App\Repository\GenreRepository;
use App\Repository\ConsoleRepository;
use App\Repository\LicenseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => false,
                'label' => 'games.form.name.label',
                'attr' => [
                    'placeholder' => 'games.form.name.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('releaseDateMin', DateType::class, [
                'required' => false,
                'label' => 'games.form.release_date_min.label',
                'attr' => [
                    'placeholder' => 'games.form.release_date_min.placeholder',
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
                'label' => 'games.form.release_date_max.label',
                'attr' => [
                    'placeholder' => 'games.form.release_date_max.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
            ->add('nbPlayersMin', IntegerType::class, [
                'required' => false,
                'label' => 'games.form.player_numbers_min.label',
                'attr' => [
                    'placeholder' => 'games.form.player_numbers_min.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('nbPlayersMax', IntegerType::class, [
                'required' => false,
                'label' => 'games.form.player_numbers_max.label',
                'attr' => [
                    'placeholder' => 'games.form.player_numbers_max.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('license', EntityType::class, [
                'required' => false,
                'label' => 'games.form.licence.label',
                'placeholder' => 'games.form.licence.placeholder',
                'class' => License::class,
                'choice_label' => 'name',
                'query_builder' => function(LicenseRepository $licenseRepository){
                    return $licenseRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('console', EntityType::class, [
                'required' => false,
                'label' => 'games.form.console.label',
                'placeholder' => 'games.form.console.placeholder',
                'class' => Console::class,
                'choice_label' => 'name',
                'query_builder' => function(ConsoleRepository $consoleRepository){
                    return $consoleRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('genre', EntityType::class, [
                'required' => false,
                'label' => 'games.form.genre.label',
                'placeholder' => 'games.form.genre.placeholder',
                'class' => Genre::class,
                'choice_label' => 'name',
                'query_builder' => function(GenreRepository $genreRepository){
                    return $genreRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-6'
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
            'data_class' => Game::class,
        ]);
    }
}
