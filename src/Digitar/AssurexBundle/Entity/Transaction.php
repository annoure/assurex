<?php

namespace Digitar\AssurexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="dgtr_transaction")
 * @ORM\Entity(repositoryClass="Digitar\AssurexBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string", length=255)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="communication", type="string", length=255)
     */
    private $communication;

    /**
     * @ORM\ManyToOne(targetEntity="Digitar\AssurexBundle\Entity\Member", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    public function __construct()
    {
        $this->date = new \Datetime();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Transaction
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return Transaction
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set communication
     *
     * @param string $communication
     *
     * @return Transaction
     */
    public function setCommunication($communication)
    {
        $this->communication = $communication;

        return $this;
    }

    /**
     * Get communication
     *
     * @return string
     */
    public function getCommunication()
    {
        return $this->communication;
    }



    /**
     * Set member
     *
     * @param \Digitar\AssurexBundle\Entity\Member $member
     *
     * @return Transaction
     */
    public function setMember(\Digitar\AssurexBundle\Entity\Member $member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Digitar\AssurexBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }
}
