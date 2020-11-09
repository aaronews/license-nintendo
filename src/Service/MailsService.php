<?php

namespace App\Service;

use App\Entity\User;
use Twig\Environment;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

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
    public function __construct(MailerInterface $mailer, Environment $twig, RouterInterface $router, TranslatorInterface $translator, string $adminEmail)
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
        return;
        $this->mailer->send(
            (new TemplatedEmail())
            ->from($this->adminEmail)
            ->to($user->getUsername())
            ->subject($this->translator->trans('mails.signup.subject'))
            ->htmlTemplate('mails/sign-up.html.twig')
            ->context([
                'activationUrl' => $this->router->generate('activate_user', array('token' => $user->getToken()))
            ])
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
    public function sendMailResetPassword(User $user, array $data){
        return;

        $this->mailer->send((new TemplatedEmail())
            //->from(new Address('alexandre.chantraine11@gmail.com', 'Licences Nintendo'))
            ->from($this->adminEmail)
            ->to($user->getUsername())
            ->subject($this->translator->trans('mails.reset_password.subject'))
            ->htmlTemplate('mails/reset_password.html.twig')
            ->context($data)
        );
        return;
    }
}