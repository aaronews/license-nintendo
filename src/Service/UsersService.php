<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\AbstractEntity;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersService extends AbstractEntityService 
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var MailsService
     */
    private $mailsService;

    /**
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param MailsService $mailsService
     */
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder, MailsService $mailsService)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailsService = $mailsService;
    }
    
    /**
     * Create an user and send email sign up
     *
     * @param User $user
     * @return void
     */
    public function createUser(User $user)
    {
        $this
            ->encodePassword($user, $user->getPassword())
            ->setToken($this->generateHashKeyForUserEntity($user, 'singup'))
        ;

        parent::saveEntity($user, false);
        $this->mailsService->sendMailSignUp($user);

        return;
    }

    /**
     * @param User $user
     * @param string $sPrefix
     * @return string
     */
    public function generateHashKeyForUserEntity(User $user, string $prefix)
    {
        return sha1(spl_object_hash($user) . '_' . str_shuffle(uniqid($prefix)));
    }

    /**
     * Change user password to new encoded password
     *
     * @param User $user
     * @param string $password
     * @return User
     */
    public function encodePassword(User $user, string $password){
        return $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
    }
}