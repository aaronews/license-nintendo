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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/characters", name="characters_")
 */
class CharacterController extends AbstractController
{

    /**
     * @Route("/list", name="list")
     */
    public function list(CharactersService $itemsService, PaginatorInterface $paginator, Request $request)
    {
        $search = new SearchCharacter();
        $form = $this->createForm(CharacterType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && !$form->isValid()){
            $search = new SearchCharacter();
        }

        $characters = $paginator->paginate(
            $itemsService->findBySearchCriterias($search),
            $request->query->getInt('page', 1), 
            10
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
