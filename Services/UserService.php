<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 18/01/2016
 * Time: 22:47
 */

namespace Oni\TravelPortBundle\Services;


use Doctrine\Common\Persistence\ObjectManager;
use Oni\UserManagerBundle\Service\UserServiceInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService implements UserServiceInterface{

    /**
     * @var \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $userRepository;

    /**
     * @var string
     */
    protected $class;



    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        ObjectManager $objectManager,
        $class
    )
    {

        $this->encoderFactory = $encoderFactory;
        $this->userRepository = $objectManager->getRepository($class);

        $metadata = $objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();

    }

    public function findByUsername($username)
    {
        return $this->userRepository->findOneBy(array('username' => $username));
    }


    public function findUserBy( array $criteria )
    {
        return  $this->userRepository->findBy($criteria);
    }


    public function getEntityClass()
    {
        return $this->userRepository->getClassName();
    }

    public function findAll() {
        return $this->userRepository->findAll();
    }

    public function getUserHighestAccessLevel(User $user)
    {

        $highestAccessLevel = 1;

        foreach ($user->getGroups() as $group){
            $highestAccessLevel = ($group->getAccessLevel() > $highestAccessLevel) ? $group->getAccessLevel() : $highestAccessLevel;
        }

        return $highestAccessLevel;

    }


}