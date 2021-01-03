<?php

namespace App\Form\Games;

use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Console;
use App\Entity\License;
use App\Repository\GenreRepository;
use App\Repository\ConsoleRepository;
use App\Repository\LicenseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AbstractGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'games.form.name.label',
                'attr' => [
                    'placeholder' => 'games.form.name.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'games.form.description.label',
                'row_attr' => [
                    'class' => 'col-sm-6 tynimce-editor'
                ],
            ])
            ->add('slug', TextType::class, [
                'required' => true,
                'label' => 'games.form.slug.label',
                'attr' => [
                    'placeholder' => 'games.form.slug.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'help' => 'form.slug.help',
                'help_attr' => [
                    'class' => 'generate-slug btn btn-default'
                ],
            ])
            ->add('history', TextareaType::class, [
                'required' => false,
                'label' => 'games.form.history.label',
                'row_attr' => [
                    'class' => 'col-sm-6 tynimce-editor'
                ],
            ])
            ->add('releaseDate', DateTimeType::class, [
                'required' => true,
                'label' => 'games.form.release_date.label',
                'attr' => [
                    'placeholder' => 'games.form.release_date.placeholder',
                    'class' => 'datepicker',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy', 
                'html5' => false,
            ])
            ->add('nbPlayers', IntegerType::class, [
                'required' => true,
                'label' => 'games.form.player_numbers_min.label',
                'attr' => [
                    'placeholder' => 'games.form.player_numbers_min.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('copiesSold', IntegerType::class, [
                'required' => true,
                'label' => 'games.form.copied_sold.label',
                'attr' => [
                    'placeholder' => 'games.form.copied_sold.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('license', EntityType::class, [
                'required' => true,
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
            ->add('consoles', EntityType::class, [
                'required' => true,
                'label' => 'games.form.console.label',
                'placeholder' => 'games.form.console.placeholder',
                'multiple' => true,
                'class' => Console::class,
                'choice_label' => 'name',
                'query_builder' => function(ConsoleRepository $consoleRepository){
                    return $consoleRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('genres', EntityType::class, [
                'required' => true,
                'label' => 'games.form.genre.label',
                'placeholder' => 'games.form.genre.placeholder',
                'multiple' => true,
                'class' => Genre::class,
                'choice_label' => 'name',
                'query_builder' => function(GenreRepository $genreRepository){
                    return $genreRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('uploadBackgroundDesktop', FileType::class, [
                'required' => false,
                'label' => 'games.form.background_desktop.label',
                'row_attr' => [
                    'class' => 'col-sm-6 col-12'
                ],
            ])
            ->add('uploadBackgroundMobile', FileType::class, [
                'required' => false,
                'label' => 'games.form.background_mobile.label',
                'row_attr' => [
                    'class' => 'col-sm-6 col-12'
                ],
            ])
            ->add('backgroundPosition', TextType::class, [
                'required' => true,
                'label' => 'games.form.background_position.label',
                'attr' => [
                    'placeholder' => 'games.form.background_position.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
                ],
            ])
            ->add('firstBlockMinHeight', IntegerType::class, [
                'required' => true,
                'label' => 'games.form.first_block_min_height.label',
                'attr' => [
                    'placeholder' => 'games.form.first_block_min_height.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-6'
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
