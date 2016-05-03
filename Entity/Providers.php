<?php

namespace Oni\TravelPortBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Providers
 *
 * @ORM\Table(name="oni_providers")
 * @ORM\Entity(repositoryClass="Oni\TravelPortBundle\Repository\ProvidersRepository")
 */
class Providers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="providerName", type="string", length=50, unique=true)
     */
    private $providerName;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var bool
     *
     * @ORM\Column(name="webProvider", type="boolean")
     */
    private $webProvider;



    /**
     * @var string
     *
     * @ORM\Column(name="providerId", type="string")
     */
    private $providerId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set providerName
     *
     * @param string $providerName
     *
     * @return Providers
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * Get providerName
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Providers
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }



    /**
     * Set isFlightProvider
     *
     * @param boolean $isFlightProvider
     *
     * @return Providers
     */
    public function setIsFlightProvider($isFlightProvider)
    {
        $this->isFlightProvider = $isFlightProvider;

        return $this;
    }

    /**
     * Get isFlightProvider
     *
     * @return bool
     */
    public function getIsFlightProvider()
    {
        return $this->isFlightProvider;
    }

    /**
     * Set isCarRentalProvider
     *
     * @param boolean $isCarRentalProvider
     *
     * @return Providers
     */
    public function setIsCarRentalProvider($isCarRentalProvider)
    {
        $this->isCarRentalProvider = $isCarRentalProvider;

        return $this;
    }

    /**
     * Get isCarRentalProvider
     *
     * @return bool
     */
    public function getIsCarRentalProvider()
    {
        return $this->isCarRentalProvider;
    }

    /**
     * Set isHotelProvider
     *
     * @param boolean $isHotelProvider
     *
     * @return Providers
     */
    public function setIsHotelProvider($isHotelProvider)
    {
        $this->isHotelProvider = $isHotelProvider;

        return $this;
    }

    /**
     * Get isHotelProvider
     *
     * @return boolean
     */
    public function getIsHotelProvider()
    {
        return $this->isHotelProvider;
    }

    /**
     * Set webProvider
     *
     * @param boolean $webProvider
     *
     * @return Providers
     */
    public function setWebProvider($webProvider)
    {
        $this->webProvider = $webProvider;

        return $this;
    }

    /**
     * Get webProvider
     *
     * @return boolean
     */
    public function getWebProvider()
    {
        return $this->webProvider;
    }

    /**
     * Set providerId
     *
     * @param string $providerId
     *
     * @return Providers
     */
    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;

        return $this;
    }

    /**
     * Get providerId
     *
     * @return string
     */
    public function getProviderId()
    {
        return $this->providerId;
    }
}
