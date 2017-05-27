<?php
// src/Digitar/AssurexBundle/DataFixtures/ORM/LoadTransaction.php

namespace Digitar\AssurexBundle\DataFixtures\ORM;

use DateInterval;
use DateTime;
use Digitar\AssurexBundle\Entity\Member;
use Digitar\AssurexBundle\Entity\Transaction;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTransaction implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {

        $member = new Member();
        $member->setName('Stephan.');
        $member->setGsm('04659865');
        $member->setMail("msteph@gmail.com");
        $member->setPhoto(null);
        $birth = new DateTime();
        $birth->sub(new DateInterval('P20Y'));
        var_dump($birth);
        $member->setBirthday($birth);




        // Liste des noms de catégorie à ajouter
        $descriptions = array(
            'Afrique',
            'Maroc',
            'Europe'
        );
        $manager->persist($member);
        foreach ($descriptions as $description) {
            // On crée la catégorie
            $transaction = new Transaction();
            $transaction->setDescription($description);
            $transaction->setCommunication($description);
            $transaction->setDate(new \DateTime());
            $transaction->setMontant(120);
            $transaction->setMember($member);
            // On la persiste
            $manager->persist($transaction);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}