<?php

namespace Oni\TravelConnectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companies
 *
 * @ORM\Table(name="companies")
 * @ORM\Entity(repositoryClass="Oni\TravelConnectBundle\Repository\CompaniesRepository")
 */
class Companies
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
     * @ORM\Column(name="Name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="CreditLimit", type="integer")
     */
    private $creditLimit;

    /**
     * @var string
     *
     * @ORM\Column(name="Credit", type="decimal", precision=10, scale=2)
     */
    private $credit;

    /**
     * @var int
     *
     * @ORM\Column(name="CeditCurrencyId", type="integer")
     */
    private $ceditCurrencyId;


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
     * Set name
     *
     * @param string $name
     *
     * @return Companies
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creditLimit
     *
     * @param integer $creditLimit
     *
     * @return Companies
     */
    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;

        return $this;
    }

    /**
     * Get creditLimit
     *
     * @return int
     */
    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    /**
     * Set credit
     *
     * @param string $credit
     *
     * @return Companies
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return string
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set ceditCurrencyId
     *
     * @param integer $ceditCurrencyId
     *
     * @return Companies
     */
    public function setCeditCurrencyId($ceditCurrencyId)
    {
        $this->ceditCurrencyId = $ceditCurrencyId;

        return $this;
    }

    /**
     * Get ceditCurrencyId
     *
     * @return int
     */
    public function getCeditCurrencyId()
    {
        return $this->ceditCurrencyId;
    }
}

