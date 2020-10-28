<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use App\Service\CharactersService;
use App\Form\Characters\AddCharacterType;
use App\Form\Characters\EditCharacterType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;


/**
 * @Route("/admin/characters", name="admin_characters_")
 */
class CharacterController extends AbtsractAdminController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(CharactersService $charactersService, PaginatorInterface $paginator, Request $request)
    {
        return $this->render('admin/character/list.html.twig', [
            'breadcrumbs' => $this->buildBreadcrumbs(),
            'characters' => $paginator->paginate(
                $charactersService->getPaginateElements(),
                $request->query->getInt('page', 1), 
                10
            )
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(CharactersService $charactersService, Request $request){
        $character = new Character();
        $form = $this->createForm(AddCharacterType::class, $character);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $charactersService->saveEntity($character, false);
            $this->addFlash('success', 'admin.characters.add.flash_success');
            $form = $this->createForm(AddCharacterType::class, new Character());
        }
        return $this->render('admin/character/add.html.twig', [
            'form' => $form->createView(),
            'breadcrumbs' => $this->buildBreadcrumbs(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Character $character, CharactersService $charactersService, Request $request){
        $form = $this->createForm(EditCharacterType::class, $character);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $charactersService->saveEntity($character, true);
            $this->addFlash('success', 'admin.characters.edit.flash_success');
        }
        
        return $this->render('admin/character/edit.html.twig', [
            'form' => $form->createView(),
            'character' => $character,
            'breadcrumbs' => $this->buildBreadcrumbs($character),
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(Character $character, CharactersService $charactersService){
        $charactersService->removeEntity($character);
        $this->addFlash('success', 'admin.characters.remove.flash_success');
        return $this->redirectToRoute('admin_characters_list');
    }

    /**
     * @param Character|null $character
     * @return Breadcrumbs
     */
    protected function buildBreadcrumbs(?Character $character = null){
        parent::buildBreadcrumbs();
        $this->breadcrumbs->addItem($this->translator->trans('layout.header.links.characters'), $this->router->generate('admin_characters_list'));

        switch($this->request->get('_route')){
            case 'admin_characters_add':
                $this->breadcrumbs->addItem($this->translator->trans('admin.characters.add.title'));
                break;
            case 'admin_characters_edit':
                $this->breadcrumbs->addItem($character->getName());
                break;
            default:
                break;
        }

        return $this->breadcrumbs;
    }
}
