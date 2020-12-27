<?php

namespace App\Service;

use App\Entity\User;
use Twig\Environment;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MailsService
{

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;
    
    /**
     * @var RouterInterface
     */
    protected  $router;
    
    /**
     * @var TranslatorInterface
     */
    protected  $translator;

    /**
     * @var string
     */
    private $adminEmail;

    /**
     * @param MailerInterface $mailer
     * @param Environment $twig
     * @param RouterInterface $router
     * @param TranslatorInterface $translator
     * @param string $adminEmail
     */
    public function __construct(\Swift_Mailer  $mailer, Environment $twig, RouterInterface $router, TranslatorInterface $translator, string $adminEmail)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->router = $router;
        $this->translator = $translator;
        $this->adminEmail = $adminEmail;
    }


    /**
     * Send sign up email to user
     *
     * @param User $user
     * @return void
     */
    public function sendMailSignUp(User $user)
    {
        $subject = $this->translator->trans('mails.signup.subject');
        $this->mailer->send(
            (new \Swift_Message($subject))
            ->setFrom($this->adminEmail)
            ->setTo($user->getUsername())
            ->setBody(
                $this->twig->render(
                    'mails/sign-up.html.twig',
                    [
                        'activationUrl' => $this->router->generate('activate_user', ['token' => $user->getToken()], UrlGeneratorInterface::ABSOLUTE_URL),
                        'subject' => $subject
                    ]
                ),
                'text/html'
            )
        );
        return;
    }


    /**
     * Send reset password email to user
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    public function sendMailResetPassword(User $user, array $data)
    {
        $subject = $this->translator->trans('mails.reset_password.subject');
        $data['subject'] = $subject;
        $this->mailer->send(
            (new \Swift_Message($subject))
            ->setFrom($this->adminEmail)
            ->setTo($user->getUsername())
            ->setBody(
                $this->twig->render(
                    'mails/reset_password.html.twig',
                    $data,
                ),
                'text/html'
            )
        );
        return;
    }
}