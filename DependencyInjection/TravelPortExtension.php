<?php

namespace Oni\TravelPortBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class TravelPortExtension extends Extension implements  PrependExtensionInterface
{

    /**
     * @var ContainerBuilder
     */
    protected $container;

    protected $providerNameSpace = '\\Oni\\TravelPortBundle\\Providers\\';

    protected $providerPostFix = 'Provider';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $this->container = $container;
        $configuration = new Configuration($this->getAlias());
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('frontend_services.yml');
        $loader->load('frontend_factories.yml');
        $loader->load('provider_services.yml');
        $loader->load('factories.yml');

        
        if ($container->hasParameter('oni_travel_port')) {

            $params = $container->getParameter('oni_travel_port');
            /**
             *
             * Prepare Providers
             *
             */
            if (!empty($params['providers'])) {

                foreach ( $params['providers'] as $providerName => $providerConf ) {

                    $this->prepareProvider( $providerName, $providerConf );

                }
            }

            if (!empty($params['theme'])) {
                //Set design theme by config
                $container->setParameter( 'oni_travel_port.theme',
                    isset( $params['theme'] ) ? $params['theme'] : 'default' );
            }

            if ( isset( $params['travel_port_url'] ) ) {
                //Set default url param
                $container->setParameter( 'oni_travel_port.default_url',
                    isset( $params['travel_port_url'] ) ? $params['travel_port_url'] : 'tc' );
            }

        }

    }

  /**
   *
   * Prepare Travel Service provider
   *
   * @param string $providerName
   * @param array $providerConf
   *
   */
    public function prepareProvider($providerName, $providerConf){

        //Set provider class and call function
        $providerClass  = (string)$this->providerNameSpace.ucwords($providerName).'\\'.ucwords($providerName).$this->providerPostFix;

        if (!class_exists($providerClass))
            throw new \Exception('Travel Service provider class '.$providerClass.' does not exist');

        $providerCallFunction = $providerClass.'::prepare';

      /**
       * Configure provider by provider class static function ::prepare()
       * passing the container and provider config
       */
      call_user_func_array($providerCallFunction,
        array(
          $this->container,
          $providerConf
        )
      );

    }


    public function prepend(ContainerBuilder $container)
    {

        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'twig':
                    //Add template theme paths
                    $appRootPath = $container->getParameter('kernel.root_dir');
                    $config = array(
                      'paths' => array(
                        $appRootPath.'/../oni-themes/travel_port'=> 'travel_port'
                      )
                    );
                    $container->prependExtensionConfig($name, $config);
                    break;
            }
        }

    }



}
