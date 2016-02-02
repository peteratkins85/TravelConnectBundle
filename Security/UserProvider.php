<?php

namespace Oni\TravelConnectBundle\Security;


use Oni\TravelConnectBundle\Entity\Repository\UsersRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Oni\TravelConnectBundle\Entity\User;


class UserProvider implements UserProviderInterface
{

    protected $userRepository;
    protected $doctrine;

    public function __construct(UsersRepository $userRepository, $doctrine){

        $this->userRepository = $userRepository;
        $this->doctrine = $doctrine;

    }

    public function loadUserByUsername($username)
    {

        if ($username) {

            $user = $this->userRepository->findByUsername($username)[0];

        }

        if (!$user instanceof User || empty($user)) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }else {

            return $user;

        }

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Oni\TravelConnectBundle\Entity\Users';
    }
}