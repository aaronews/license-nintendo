<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\Search\CharacterType;
use App\Service\CharactersService;
use App\Entity\AbstractDisplayableEntity;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Search\Character as SearchCharacter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/characters", name="characters_")
 */
class CharacterController extends AbstractController
{

    /**
     * @Route("/list", name="list")
     */
    public function list(CharactersService $charactersService, PaginatorInterface $paginator, Request $request, SessionInterface $session)
    {
        $search = new SearchCharacter();
        $form = $this->createForm(CharacterType::class, $search);
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 1);

        if($form->isSubmitted()){
            if($form->isValid()){
                $page = 1;
                $session->set('characterSearchData', $form->getData($search)->toArray());
            }else{
                $search = new SearchCharacter();
            }
        }elseif($session->has('characterSearchData')){
            $charactersService->hydrateSearch($session->get('characterSearchData'), $search);
            $form->setData($search);
        }

        $characters = $paginator->paginate(
            $charactersService->findBySearchCriterias($search),
            $page, 
            8
        );
        return $this->render('character/list.html.twig', [
            'characters' => $characters,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="view", requirements={"slug"=AbstractDisplayableEntity::SLUG_PATTERN})
     */
    public function view(Character $character)
    {
        return $this->render('character/view.html.twig', [
            'character' => $character
        ]);
    }
}
