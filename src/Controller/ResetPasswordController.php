<?php

namespace App\Controller;

use App\Form\ResetPassword\ChangePasswordFormType;
use App\Form\ResetPassword\ResetPasswordRequestFormType;
use App\Service\MailsService;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

/**
 * @Route("/reset-password")
 */
class ResetPasswordController extends AbstractController
{
    use ResetPasswordControllerTrait;

    private $resetPasswordHelper;

    public function __construct(ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->resetPasswordHelper = $resetPasswordHelper;
    }

    /**
     * Display & process form to request a password reset.
     *
     * @Route("/forgot-password", name="forgot_password")
     */
    public function forgotPassword(Request $request, MailsService $mailsService, UsersService $usersService): Response
    {
        if ($this->getUser()) {
             return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(ResetPasswordRequestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $usersService->findOneBy(['username' => $form->get('username')->getData()]);

            $this->setCanCheckEmailInSession();

            if (!$user) {
                return $this->redirectToRoute('forgot_password_confirm');
            }

            try {
                $mailsService->sendMailResetPassword($user, [
                    'resetToken' => $this->resetPasswordHelper->generateResetToken($user),
                    'tokenLifetime' => $this->resetPasswordHelper->getTokenLifetime(),
                ]);
                return $this->redirectToRoute('forgot_password_confirm');
            } catch (ResetPasswordExceptionInterface $e) {
                $this->addFlash('reset_password_error', 'reset_password.forgot_password.error');
            }
        }

        return $this->render('reset_password/forgot_password.html.twig', [
            'requestForm' => $form->createView(),
        ]);
    }

    /**
     * Confirmation page after a user has requested a password reset.
     *
     * @Route("/forgot-password-confirm", name="forgot_password_confirm")
     */
    public function forgotPassworConfirm(): Response
    {
        // We prevent users from directly accessing this page
        if (!$this->canCheckEmail()) {
            return $this->redirectToRoute('forgot_password');
        }

        return $this->render('reset_password/forgot_password_confirm.html.twig', [
            'tokenLifetime' => $this->resetPasswordHelper->getTokenLifetime(),
        ]);
    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     *
     * @Route("/reset/{token}", name="reset_password")
     */
    public function reset(Request $request, string $token = null, UsersService $usersService): Response
    {
        if ($token) {
            $this->storeTokenInSession($token);
            return $this->redirectToRoute('reset_password');
        }

        $token = $this->getTokenFromSession();
        if (null === $token) {
            throw $this->createNotFoundException('reset_password.reset_password.token_not_found');
        }

        try {
            $user = $this->resetPasswordHelper->validateTokenAndFetchUser($token);
        } catch (ResetPasswordExceptionInterface $e) {
            $this->addFlash('reset_password_error', 'reset_password.reset_password.fail_validate_request');
            return $this->redirectToRoute('forgot_password');
        }

        // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->resetPasswordHelper->removeResetRequest($token);

            $usersService->saveEntity(
                $usersService->encodePassword($user, $form->get('plainPassword')->getData()), 
                true
            );

            $this->cleanSessionAfterReset();
            $this->addFlash('reset_password_success', 'reset_password.reset_password.success');
            return $this->redirectToRoute('login');
        }

        return $this->render('reset_password/reset_password.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }
}
