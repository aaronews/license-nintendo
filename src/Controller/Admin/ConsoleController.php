<?php

namespace App\Controller\Admin;

use App\Entity\Console;
use App\Service\ConsolesService;
use App\Form\Consoles\AddConsoleType;
use App\Form\Consoles\EditConsoleType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/consoles", name="admin_consoles_")
 */
class ConsoleController extends AbtsractAdminController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ConsolesService $consoleService, PaginatorInterface $paginator, Request $request)
    {
        return $this->render('admin/console/list.html.twig', [
            'breadcrumbs' => $this->buildBreadcrumbs(),
            'consoles' => $paginator->paginate(
                $consoleService->getPaginateElements(),
                $request->query->getInt('page', 1), 
                10
            )
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
            'breadcrumbs' => $this->buildBreadcrumbs(),
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
            'breadcrumbs' => $this->buildBreadcrumbs($console),
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

    /**
     * @param Console|null $console
     * @return Breadcrumbs
     */
    protected function buildBreadcrumbs(?Console $console = null){
        parent::buildBreadcrumbs();
        $this->breadcrumbs->addItem($this->translator->trans('layout.header.links.consoles'), $this->router->generate('admin_consoles_list'));

        switch($this->request->get('_route')){
            case 'admin_consoles_add':
                $this->breadcrumbs->addItem($this->translator->trans('admin.consoles.add.title'));
                break;
            case 'admin_consoles_edit':
                $this->breadcrumbs->addItem($console->getName());
                break;
            default:
                break;
        }

        return $this->breadcrumbs;
    }
}
