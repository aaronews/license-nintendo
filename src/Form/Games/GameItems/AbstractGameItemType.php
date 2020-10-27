<?php

namespace App\Form\Games\GameItems;

use App\Entity\Item;
use App\Entity\GameItem;
use App\Repository\ItemRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbstractGameItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('item', EntityType::class, array(
                'required' => true,
                'label' => 'game_items.form.item.label',
                'placeholder' => 'game_items.form.item.placeholder',
                'class' => Item::class,
                'choice_label' => 'name',
                'query_builder' => function(ItemRepository $itemRepository){
                    return $itemRepository->findAllSortByProperty('name');
                },
                'row_attr' => array(
                    'class' => 'col-12'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameItem::class,
        ]);
    }
}
