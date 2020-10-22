<?php

namespace App\Controller\Admin;

use App\Service\LicensesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/licenses", name="admin_licenses_")
 */
class LicenseController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(LicensesService $licensesService)
    {
        return $this->render('admin/license/list.html.twig', [
            'licenses' => $licensesService->findAll(array('name' => 'ASC'))
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(){
        return $this->render('admin/license/add.html.twig', [
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(){
        return $this->render('admin/license/edit.html.twig', [
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(){
        return $this->redirectToRoute('admin_licenses_list');
    }
}
