<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use App\Service\ItemsService;
use App\Form\Items\AddItemType;
use App\Form\Items\EditItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin/items", name="admin_items_")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ItemsService $itemsService)
    {
        return $this->render('admin/item/list.html.twig', [
            'items' => $itemsService->findAll(array('name' => 'ASC'))
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(ItemsService $itemsService, Request $request){
        $item = new Item();
        $form = $this->createForm(AddItemType::class, $item);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $itemsService->saveEntity($item, false);
            $this->addFlash('success', 'admin.items.add.flash_success');
            $form = $this->createForm(AddItemType::class, new Item());
        }
        return $this->render('admin/item/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Item $item, ItemsService $itemsService, Request $request){
        $form = $this->createForm(EditItemType::class, $item);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $itemsService->saveEntity($item, true);
            $this->addFlash('success', 'admin.items.edit.flash_success');
        }
        
        return $this->render('admin/item/edit.html.twig', [
            'form' => $form->createView(),
            'item' => $item,
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(Item $item, ItemsService $itemsService){
        $itemsService->removeEntity($item);
        $this->addFlash('success', 'admin.items.remove.flash_success');
        return $this->redirectToRoute('admin_items_list');
    }
}
