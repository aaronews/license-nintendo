<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use App\Service\ItemsService;
use App\Form\Items\AddItemType;
use App\Form\Items\EditItemType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin/items", name="admin_items_")
 */
class ItemController extends AbtsractAdminController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ItemsService $itemsService, PaginatorInterface $paginator, Request $request)
    {
        return $this->render('admin/item/list.html.twig', [
            'breadcrumbs' => $this->buildBreadcrumbs(),
            'items' => $paginator->paginate(
                $itemsService->getPaginateElements(),
                $request->query->getInt('page', 1), 
                10
            )
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
            'breadcrumbs' => $this->buildBreadcrumbs(),
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
            'breadcrumbs' => $this->buildBreadcrumbs($item),
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

    /**
     * @param Item|null $item
     * @return Breadcrumbs
     */
    protected function buildBreadcrumbs(?Item $item = null){
        parent::buildBreadcrumbs();
        $this->breadcrumbs->addItem($this->translator->trans('layout.header.links.items'), $this->router->generate('admin_items_list'));

        switch($this->request->get('_route')){
            case 'admin_items_add':
                $this->breadcrumbs->addItem($this->translator->trans('admin.items.add.title'));
                break;
            case 'admin_items_edit':
                $this->breadcrumbs->addItem($item->getName());
                break;
            default:
                break;
        }

        return $this->breadcrumbs;
    }
}
