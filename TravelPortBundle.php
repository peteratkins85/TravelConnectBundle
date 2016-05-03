<?php

namespace Oni\TravelPortBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Oni\TravelPortBundle\DependencyInjection\Compiler\TravelPortCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TravelPortBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TravelPortCompilerPass());
    }


}
