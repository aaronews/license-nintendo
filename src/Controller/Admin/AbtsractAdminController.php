<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbtsractAdminController extends AbstractController
{
    /**
     * @var Breadcrumbs
     */
    protected  $breadcrumbs;

    /**
     * @var Request
     */
    protected  $request;
    
    /**
     * @var Router
     */
    protected  $router;
    
    /**
     * @var TranslatorInterface 
     */
    protected  $translator;

    public function __construct(Breadcrumbs $breadcrumbs, RequestStack $requestStack, RouterInterface $router, TranslatorInterface $translator){
        $this->breadcrumbs = $breadcrumbs;
        $this->request = $requestStack->getCurrentRequest();
        $this->router = $router;
        $this->translator = $translator;
    }

    protected function buildBreadcrumbs(){
        if($this->request->get('_route') === 'admin_dashboard'){
            $this->breadcrumbs->addItem($this->translator->trans('admin.layout.header.links.dashboard'));
        }else{
            $this->breadcrumbs->addItem($this->translator->trans('admin.layout.header.links.dashboard'), $this->router->generate('admin_dashboard'));
        }

        return $this->breadcrumbs;
    }
}
