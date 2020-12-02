<?php

namespace App\Controller;

use App\Entity\Console;
use App\Form\Search\ConsoleType;
use App\Service\ConsolesService;
use App\Entity\AbstractDisplayableEntity;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Search\Console as SearchConsole;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/consoles", name="consoles_")
 */
class ConsoleController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(ConsolesService $consolesService, PaginatorInterface $paginator, Request $request, SessionInterface $session)
    {
        $search = new SearchConsole();
        $form = $this->createForm(ConsoleType::class, $search);
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 1);

        if($form->isSubmitted()){
            if($form->isValid()){
                $page = 1;
                $session->set('consoleSearchData', $form->getData($search)->toArray());
            }else{
                $search = new SearchConsole();
            }
        }elseif($session->has('consoleSearchData')){
            $consolesService->hydrateSearch($session->get('consoleSearchData'), $search);
            $form->setData($search);
        }

        $consoles = $paginator->paginate(
            $consolesService->findBySearchCriterias($search),
            $page, 
            8
        );
        
        return $this->render('console/list.html.twig', [
            'consoles' => $consoles,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function view(Console $console)
    {
        return $this->render('console/view.html.twig', [
            'console' => $console
        ]);
    }
}
