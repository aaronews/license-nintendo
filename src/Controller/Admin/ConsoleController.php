<?php

namespace App\Controller\Admin;

use App\Service\ConsolesService;
use CS\ZF\Core\Builder\Service\ConsoleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/consoles", name="admin_consoles_")
 */
class ConsoleController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ConsolesService $consoleService)
    {
        return $this->render('admin/console/list.html.twig', [
            'consoles' => $consoleService->findAll(array('releaseDate' => 'DESC'))
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(){
        return $this->render('admin/console/add.html.twig', [
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(){
        return $this->render('admin/console/edit.html.twig', [
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(){
        return $this->redirectToRoute('admin_consoles_list');
    }
}
