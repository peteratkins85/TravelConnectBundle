<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 25/12/15
 * Time: 19:42
 */

namespace Oni\TravelPortBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Oni\TravelPortBundle\Entity\Group;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Oni\TravelPortBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface ,FixtureInterface, ContainerAwareInterface
{


    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {

        $userGroup1 = new Group();
        $userGroup1->setName('Guest User');
        $userGroup1->setAccessLevel(1);
        $userGroup1->setRoles(array('ROLE_GUEST'));

        $userGroup2 = new Group();
        $userGroup2->setName('Standard User');
        $userGroup2->setAccessLevel(2);
        $userGroup2->setRoles(array('ROLE_USER'));

        $userGroup3 = new Group();
        $userGroup3->setName('Admin');
        $userGroup3->setAccessLevel(4);
        $userGroup3->setRoles(array('ROLE_ADMIN'));

        $userGroup4 = new Group();
        $userGroup4->setName('Super Admin');
        $userGroup4->setAccessLevel(5);
        $userGroup4->setRoles(array('ROLE_SUPER_ADMIN'));
        
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $em->persist($userGroup1);
        $em->persist($userGroup2);
        $em->persist($userGroup3);
        $em->persist($userGroup4);
        $em->flush();

        $startDate = time();

        $user = new User();
        $user->setActive(1);
        $user->setCreated(new \DateTime('now'));
        $user->setCredentialsExpireAt(new \DateTime('+ 2 years'));
        $user->setCredentialsExpired(0);
        $user->setEmail('admin@oni-travelconnect.com');
        $user->setExpired(0);
        $password = $this->container->get('security.password_encoder')->encodePassword($user,'admin');
        $user->setPassword($password);
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->addGroup($userGroup4);
        $user->setExpiresAt(new \DateTime('+ 2 years'));
        $user->setEnabled(1);


        $em->persist($user);
        $em->flush();
//
//        $this->addReference('user', $user);

    }

    public function getOrder()
    {
        return 2;
    }
}
