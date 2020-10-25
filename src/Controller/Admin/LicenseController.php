<?php

namespace App\Controller\Admin;

use App\Entity\License;
use App\Service\LicensesService;
use App\Form\Licenses\AddLicenseType;
use App\Form\Licenses\EditLicenseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
    public function add(LicensesService $licensesService, Request $request){
        $license = new License();
        $form = $this->createForm(AddLicenseType::class, $license);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $licensesService->saveEntity($license, false);
            $this->addFlash('success', 'admin.licenses.add.flash_success');
            $form = $this->createForm(AddLicenseType::class, new License());
        }
        return $this->render('admin/license/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit(License $license, LicensesService $licensesService, Request $request){
        $form = $this->createForm(EditLicenseType::class, $license);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $licensesService->saveEntity($license, true);
            $this->addFlash('success', 'admin.licenses.edit.flash_success');
        }
        
        return $this->render('admin/license/edit.html.twig', [
            'form' => $form->createView(),
            'license' => $license,
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove", requirements={"id"="\d+"})
     */
    public function remove(License $license, LicensesService $licensesService){
        $licensesService->removeEntity($license);
        $this->addFlash('success', 'admin.licenses.remove.flash_success');
        return $this->redirectToRoute('admin_licenses_list');
    }
}
