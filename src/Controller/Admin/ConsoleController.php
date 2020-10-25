<?php

namespace App\Controller\Admin;

use App\Entity\Console;
use App\Service\ConsolesService;
use App\Form\Consoles\AddConsoleType;
use App\Form\Consoles\EditConsoleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
    public function add(ConsolesService $consoleService, Request $request){
        $console = new Console();
        $form = $this->createForm(AddConsoleType::class, $console);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $consoleService->saveEntity($console, false);
            $this->addFlash('success', 'admin.consoles.add.flash_success');
            $form = $this->createForm(AddConsoleType::class, new Console());
        }

        return $this->render('admin/console/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(Console $console, ConsolesService $consoleService, Request $request){
        $form = $this->createForm(EditConsoleType::class, $console);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $consoleService->saveEntity($console, true);
            $this->addFlash('success', 'admin.consoles.edit.flash_success');
        }
        return $this->render('admin/console/edit.html.twig', [
            'form' => $form->createView(),
            'console' => $console,
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(Console $console, ConsolesService $consoleService){
        $consoleService->removeEntity($console);
        $this->addFlash('success', 'admin.consoles.remove.flash_success');
        return $this->redirectToRoute('admin_consoles_list');
    }
}
