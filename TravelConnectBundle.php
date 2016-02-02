<?php

namespace Oni\TravelConnectBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Oni\TravelConnectBundle\DependencyInjection\Compiler\TravelConnectCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TravelConnectBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TravelConnectCompilerPass());
    }


}
