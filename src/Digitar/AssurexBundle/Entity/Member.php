<?php

namespace Digitar\AssurexBundle\Entity;

use DateTime;
use Digitar\AssurexBundle\Entity\Photo;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="Digitar\AssurexBundle\Repository\MemberRepository")
 */
class Member
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="gsm", type="string", length=255, unique=true)
     */
    private $gsm;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true, unique=true)
     */
    private $mail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     */
    private $birthday;


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
     * @return Member
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
     * Set gsm
     *
     * @param string $gsm
     *
     * @return Member
     */
    public function setGsm($gsm)
    {
        $this->gsm = $gsm;

        return $this;
    }

    /**
     * Get gsm
     *
     * @return string
     */
    public function getGsm()
    {
        return $this->gsm;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Member
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Member
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getAge()
    {
        $birthday = new DateTime($this->birthday);
        $interval = $birthday->diff(new DateTime);
        echo $interval->y;
    }
    /**
     * @ORM\Column(name="status", type="boolean")
     */
    private $status = true;


    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->status = true;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Member
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @ORM\OneToOne(targetEntity="\Digitar\AssurexBundle\Entity\Photo", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $photo;

    /**
     * Set photo
     *
     * @param \Digitar\AssurexBundle\Entity\Photo $photo
     *
     * @return Member
     */
    public function setPhoto(\Digitar\AssurexBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Digitar\AssurexBundle\Entity\Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Digitar\AssurexBundle\Entity\TypeContrat", cascade={"persist"})
     * @ORM\JoinTable(name="dgtr_member_typecontrat")
     */
    private $typeContrats;

    /**
     * Add typeContrat
     *
     * @param \Digitar\AssurexBundle\Entity\TypeContrat $typeContrat
     *
     * @return Member
     */
    public function addTypeContrat(\Digitar\AssurexBundle\Entity\TypeContrat $typeContrat)
    {
        $this->typeContrats[] = $typeContrat;

        return $this;
    }

    /**
     * Remove typeContrat
     *
     * @param \Digitar\AssurexBundle\Entity\TypeContrat $typeContrat
     */
    public function removeTypeContrat(\Digitar\AssurexBundle\Entity\TypeContrat $typeContrat)
    {
        $this->typeContrats->removeElement($typeContrat);
    }

    /**
     * Get typeContrats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeContrats()
    {
        return $this->typeContrats;
    }
}
