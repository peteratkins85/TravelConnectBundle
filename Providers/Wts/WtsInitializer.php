<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 03/06/2016
 * Time: 14:00
 */

namespace Oni\TravelPortBundle\Providers\Wts;


use Oni\TravelPortBundle\Providers\ProviderInitializerInterface;
use Oni\TravelPortBundle\TravelPortGlobals;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WtsInitializer implements ProviderInitializerInterface {

	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected $container;

	const CURRENCIES = array(
		'AED',
		'EUR',
		'GBP',
		'INR',
		'USD'
	);

	public function __construct(ContainerBuilder $container) {

		$this->container = $container;

	}

	/**
	 *
	 * Use by configuration class
	 * set parameters
	 *
	 * @param $providerConf
	 *
	 * @throws \Exception
	 */
	public function init($providerConf)
	{

		if (!isset($providerConf['username']) || !isset($providerConf['password'])) {

			throw new \Exception(
				'Username and password must be set for WTS provider'
			);

		}

		//Add supported Currencies
		$this->addCurrencies();


		$this->container->setParameter(
			'oni_travel_port.wts.username',
			$providerConf['username']
		);
		$this->container->setParameter(
			'oni_travel_port.wts.password',
			$providerConf['password']
		);

		$clientId = 'oni_travel_port_provider_client.wts';

		//Check if service for API client exists
		if ($this->container->has($clientId)) {

			$args = array(
				'username' =>$providerConf['username'],
				'password' =>$providerConf['password']
			);
			$client = $this->container->findDefinition($clientId);
			$client->addArgument($args);

		}

	}

	public function addCurrencies(){

		if (!empty(self::CURRENCIES)) {

			$currencies = $this->container->getParameter( TravelPortGlobals::CURRENCY_PARAM_KEY );

			$currencies = array_merge( $currencies, self::CURRENCIES );

			$this->container->setParameter( TravelPortGlobals::CURRENCY_PARAM_KEY,
				$currencies );

		}


	}

}