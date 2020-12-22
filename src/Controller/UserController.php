<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use App\Form\EditUserType;
use App\Service\UsersService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/sign-up", name="sign_up")
     */
    public function signup(Request $request, UsersService $usersService)
    {
        if($this->getUser()){
            return $this->redirectToRoute('homepage');
        }
        
        $user = new User();
        $form = $this->createForm(SignUpType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $usersService->createUser($user);
            $this->addFlash('success','users.signup.success');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/activate-user/{token}", name="activate_user", requirements={"token"="^[a-z0-9]{40}$"})
     */
    public function activateUser(User $user, Request $request, UsersService $usersService)
    {
        if($this->getUser()){
            return $this->redirectToRoute('homepage');
        }

        $usersService->saveEntity($user->setActive(true)->setToken(null), true);
        $this->addFlash('success','users.activate_user.success');
        return $this->redirectToRoute('log_in');
    }
    /**
     * @Route("/edit-user", name="edit_user")
     */
    public function editUser(Request $request, UsersService $usersService)
    {
        if($this->getUser()){
            return $this->redirectToRoute('homepage');
        }
        
        $user = new User();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $usersService->modifyUser($user);
            $this->addFlash('success','users.editUser.success');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/edit-user.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
