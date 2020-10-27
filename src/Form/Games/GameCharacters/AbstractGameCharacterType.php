<?php

namespace App\Form\Games\GameCharacters;

use App\Entity\Character;
use App\Entity\GameCharacter;
use App\Repository\GameRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbstractGameCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currentCharacter', EntityType::class, array(
                'required' => true,
                'label' => 'game_characters.form.character.label',
                'placeholder' => 'game_characters.form.character.placeholder',
                'class' => Character::class,
                'choice_label' => 'name',
                'query_builder' => function(CharacterRepository $characterRepository){
                    return $characterRepository->findAllSortByProperty('name');
                },
                'row_attr' => array(
                    'class' => 'col-12'
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameCharacter::class,
        ]);
    }
}
