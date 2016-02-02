<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 25/12/15
 * Time: 19:42
 */

namespace Oni\ProductManagerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Oni\TravelConnectBundle\Entity\User;
use Oni\TravelConnectBundle\Entity\UserGroups;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadTcUserData extends AbstractFixture implements OrderedFixtureInterface ,FixtureInterface, ContainerAwareInterface
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

        $userGroup1 = new UserGroups();
        $userGroup1->setGroupName('Standard User');
        $userGroup1->setRoles(array('TRAVEL_CONNECT_USER'));

        $userGroup2 = new UserGroups();
        $userGroup2->setGroupName('Admin');
        $userGroup2->setRoles(array('TRAVEL_CONNECT_ADMIN','TRAVEL_CONNECT_USER'));

        $userGroup3 = new UserGroups();
        $userGroup3->setGroupName('Super Admin');
        $userGroup3->setRoles(array('TRAVEL_CONNECT_ADMIN','ROLE_ALLOWED_TO_SWITCH'));

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $em->persist($userGroup1);
        $em->persist($userGroup2);
        $em->persist($userGroup3);
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
        $user->setExpiresAt(new \DateTime('+ 2 years'));
        $user->setRoles(array('ROLE_TRAVEL_CONNECT_SUPER_ADMIN'));
        $user->setEnabled(1);
        $user->setGroup($userGroup3);



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
