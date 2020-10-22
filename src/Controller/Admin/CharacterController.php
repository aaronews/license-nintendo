<?php

namespace App\Controller\Admin;

use App\Service\CharactersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


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
    public function add(){
        return $this->render('admin/character/add.html.twig', [
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(){
        return $this->render('admin/character/edit.html.twig', [
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(){
        return $this->redirectToRoute('admin_characters_list');
    }
}
