<?php

namespace App\Controller\Admin;

use App\Service\ItemsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


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
    public function add(){
        return $this->render('admin/item/add.html.twig', [
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(){
        return $this->render('admin/item/edit.html.twig', [
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(){
        return $this->redirectToRoute('admin_items_list');
    }
}
