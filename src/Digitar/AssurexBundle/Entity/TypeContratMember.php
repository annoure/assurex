<?php

namespace Digitar\AssurexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeContratMember
 *
 * @ORM\Table(name="dgtr_type_contrat_member")
 * @ORM\Entity(repositoryClass="Digitar\AssurexBundle\Repository\TypeContratMemberRepository")
 */
class TypeContratMember
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
     * @ORM\Column(name="dateSign", type="date")
     */
    private $dateSign;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonResiliation", type="string", length=255, nullable=true)
     */
    private $raisonResiliation;

    /**
     * @ORM\ManyToOne(targetEntity="Digitar\AssurexBundle\Entity\Member")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @var string
     *
     * @ORM\Column(name="typeContrat", type="string", length=255)
     */

    /**
     * @ORM\ManyToOne(targetEntity="Digitar\AssurexBundle\Entity\TypeContrat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeContrat;


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
     * Set dateSign
     *
     * @param \DateTime $dateSign
     *
     * @return TypeContratMember
     */
    public function setDateSign($dateSign)
    {
        $this->dateSign = $dateSign;

        return $this;
    }

    /**
     * Get dateSign
     *
     * @return \DateTime
     */
    public function getDateSign()
    {
        return $this->dateSign;
    }

    /**
     * Set raisonResiliation
     *
     * @param string $raisonResiliation
     *
     * @return TypeContratMember
     */
    public function setRaisonResiliation($raisonResiliation)
    {
        $this->raisonResiliation = $raisonResiliation;

        return $this;
    }

    /**
     * Get raisonResiliation
     *
     * @return string
     */
    public function getRaisonResiliation()
    {
        return $this->raisonResiliation;
    }

    /**
     * Set member
     *
     * @param \Digitar\AssurexBundle\Entity\Member $member
     *
     * @return TypeContratMember
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

    /**
     * Set typeContrat
     *
     * @param \Digitar\AssurexBundle\Entity\TypeContrat $typeContrat
     *
     * @return TypeContratMember
     */
    public function setTypeContrat(\Digitar\AssurexBundle\Entity\TypeContrat $typeContrat)
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    /**
     * Get typeContrat
     *
     * @return \Digitar\AssurexBundle\Entity\TypeContrat
     */
    public function getTypeContrat()
    {
        return $this->typeContrat;
    }
}
