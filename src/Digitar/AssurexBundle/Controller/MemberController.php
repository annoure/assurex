<?php
/**
 * Created by PhpStorm.
 * User: gh
 * Date: 25-05-17
 * Time: 21:11
 */

// src/Digitar/AssurexBundle/Controller/MemberController.php

namespace Digitar\AssurexBundle\Controller;

use DateInterval;
use DateTime;
use Digitar\AssurexBundle\Entity\Member;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class MemberController extends Controller
{
    public function indexAction($page)
    {
        $listMembers = array(
            array(
                'id'   => 1,
                'name'      => 'Louis philippe',
                'gsm'      => '0465985632',
                'mail'      => 'lphilippe@gmail.com',
                'date'    => new \Datetime()),
            array(
                'id'   => 2,
                'name'      => 'Jean marie ',
                'gsm'      => '0498989898',
                'mail'      => 'jm@gmail.com',
                'date'    => new \Datetime()),
            array(
                'id'   => 3,
                'name'      => 'Herve',
                'gsm'      => '04723651212',
                'mail'      => 'lherve@gmail.com',
                'date'    => new \Datetime())
        );
        return $this->render('DigitarAssurexBundle:Member:index.html.twig', array(
            'listMembers' => $listMembers
        ));
    }

    public function viewAction($id)
    {

        // On récupère le repository
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('DigitarAssurexBundle:Member')
        ;

        // On récupère l'entité correspondante à l'id $id
        $member = $repository->find($id);

        // $member est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $member) {
            throw new NotFoundHttpException("Le membre d'id ".$id." n'existe pas.");
        }

        // Le render ne change pas, on passait avant un tableau, maintenant un objet
        return $this->render('DigitarAssurexBundle:Member:view.html.twig', array(
            'member' => $member
        ));

    }

    public function addAction(Request $request)
    {

        // Création de l'entité
        $member = new Member();
        $member->setName('Stephan.');
        $member->setGsm('04659865');
        $member->setMail("msteph@gmail.com");
        $birth = new DateTime();
        $birth->sub(new DateInterval('P20Y'));
        var_dump($birth);
        $member->setBirthday($birth);
        // On peut ne pas définir le statut ,
        // car ces attributs sont définis automatiquement dans le constructeur

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        /**
         * L'étape 1 dit à Doctrine de « persister » l'entité.
         * Cela veut dire qu'à partir de maintenant cette entité
         * (qui n'est qu'un simple objet !) est gérée par Doctrine.
         * Cela n'exécute pas encore de requête SQL, ni rien d'autre.
         */
        $em->persist($member);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        /**
         * L'étape 2 dit à Doctrine d'exécuter effectivement les requêtes nécessaires
         * pour sauvegarder les entités qu'on lui a dit de persister précédemment
         * (il fait donc desINSERT INTO  & Cie) ;
         */
        $em->flush();

        /**
         * TRAITEMENT SERVICE STAFF
         */
        // On récupère le service
//        $antimineur = $this->container->get('digitar_assurex.antimineur');
//
//        // Je pars du principe que $text contient le texte d'un message quelconque
//        //$date = new DateTime();
//        $date = date('Y-m-d', strtotime('-20 years'));
//
//
//        if ($antimineur->isMineur($date)) {
//            throw new \Exception('Le membre a ete detecté comme mineur !');
//        }

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire
            $this->addFlash(
                'notice',
                'Membre bien enregistré.'
            );

            // Puis on redirige vers la page de visualisation de ce membre
            /**
             * notre Member étant maintenant enregistré en base de données grâce au flush(),
             * Doctrine2 lui a attribué un id ! On peut donc utiliser$member->getId()
             * dans la génération de la route, et non un nombre fixe comme précédemment.
             */
            return $this->redirectToRoute('digitar_assurex_view', array('id' => $member->getId()));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('DigitarAssurexBundle:Member:add.html.twig', array('member' => $member));
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera le membre correspondant à $id
        $member = array(
            'id'   => 1,
            'name'      => 'Louis philippe',
            'gsm'      => '0465985632',
            'mail'      => 'lphilippe@gmail.com',
            'date'    => new \Datetime());
        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $this->addFlash(
                'notice',
                'membre bien modifié.'
            );

            return $this->redirectToRoute('digitar_assurex_view', array('id' => 5));
        }

        return $this->render('DigitarAssurexBundle:Member:edit.html.twig', array('member' => $member));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera le membre correspondant à $id

        // Ici, on gérera la suppression du membre en question

        return $this->render('DigitarAssurexBundle:Member:delete.html.twig');
    }

    public function menuAction($limit)
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listMembers = array(
            array('id' => 2, 'name' => 'Jean luc'),
            array('id' => 5, 'name' => 'Louis philippe'),
            array('id' => 9, 'name' => 'Bertrand')
        );

        return $this->render('DigitarAssurexBundle:Member:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listMembers' => $listMembers
        ));
    }
}