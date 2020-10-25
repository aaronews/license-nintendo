<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use App\Service\CharactersService;
use App\Form\Characters\AddCharacterType;
use App\Form\Characters\EditCharacterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin/characters", name="admin_characters_")
 */
class CharacterController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(CharactersService $charactersService)
    {
        return $this->render('admin/character/list.html.twig', [
            'characters' => $charactersService->findAll(array('name' => 'ASC'))
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
}
