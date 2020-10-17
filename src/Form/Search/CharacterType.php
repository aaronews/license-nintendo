<?php

namespace App\Form\Search;

use App\Entity\Game;
use App\Service\GamesService;
use App\Entity\Search\Character;
use App\Repository\GameRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,array(
                'required' => false,
                'label' => 'characters.form.name.label',
                'attr' => array(
                    'placeholder' => 'characters.form.name.placeholder',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-3'
                ),
            ))
            ->add('gender', ChoiceType::class, array(
                'required' => false,
                'label' => 'characters.form.gender.label',
                'placeholder' => 'characters.form.gender.placeholder',
                'choices' => array(
                    'characters.form.gender.options.M' => 'H',
                    'characters.form.gender.options.F' => 'F',
                ),
                'row_attr' => array(
                    'class' => 'col-sm-3'
                ),
            ))
            ->add('game', EntityType::class, array(
                'required' => false,
                'label' => 'characters.form.game.label',
                'placeholder' => 'characters.form.game.placeholder',
                'class' => Game::class,
                'choice_label' => 'name',
                'query_builder' => function(GameRepository $gameRepository){
                    return $gameRepository->findAllSortByProperty('name');
                },
                'row_attr' => array(
                    'class' => 'col-sm-6'
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'form.button.filter',
                'row_attr' => array(
                    'class' => 'col-sm-12 text-center m-auto'
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }

    public function getParent()
    {
        return AbstractSearchType::class;
    }
}
