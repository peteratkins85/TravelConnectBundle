<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 23/12/2015
 * Time: 01:21
 */

namespace Oni\CoreBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Oni\CoreBundle\Controller\CoreController;
use Doctrine\ORM\EntityRepository;



class UserControllerFactory extends CoreAbstractFactory
{

    /**
     *
     * Return Controller Class
     *
     * @param CoreController $controller
     * @return CoreController
     *
     */
    public function getController(CoreController $controller){

        $returnController = $this->prepareController($controller);

        return $returnController;

    }



}