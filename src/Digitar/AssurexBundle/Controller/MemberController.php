<?php
/**
 * Created by PhpStorm.
 * User: gh
 * Date: 25-05-17
 * Time: 21:11
 */

// src/Digitar/AssurexBundle/Controller/MemberController.php

namespace Digitar\AssurexBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class MemberController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Ici je fixe le nombre d'annonces par page à 3
        // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
        $nbPerPage = 3;

        // Pour récupérer la liste de tous les membres : on utilise findAll()
        $listMembers = $this->getDoctrine()
            ->getManager()
            ->getRepository('DigitarAssurexBundle:Member')
            ->getMembers($page, $nbPerPage)
        ;

        // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($listMembers) / $nbPerPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }
        // On donne toutes les informations nécessaires à la vue
        return $this->render('DigitarAssurexBundle:Member:index.html.twig', array(
            'listMembers' => $listMembers,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }

    public function viewAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        // Pour récupérer une seule annonce, on utilise la méthode find($id)
        $member = $em->getRepository('DigitarAssurexBundle:Member')->find($id);

        // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id n'existe pas, d'où ce if :
        if (null === $member) {
            throw new NotFoundHttpException("Le membre d'id ".$id." n'existe pas.");
        }

        // Récupération de la liste des candidatures de l'annonce
        $listTransactions = $em
            ->getRepository('DigitarAssurexBundle:Transaction')
            ->findBy(array('member' => $member))
        ;

        // Récupération des TypeContratMember de l'annonce
        $listTypeContratMember = $em
            ->getRepository('DigitarAssurexBundle:TypeContratMember')
            ->findBy(array('member' => $member))
        ;

        return $this->render('DigitarAssurexBundle:Member:view.html.twig', array(
            'member'           => $member,
            'listTransactions' => $listTransactions,
            'listTypeContratMember' => $listTypeContratMember,
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // On ne sait toujours pas gérer le formulaire, patience cela vient dans la prochaine partie !

        if ($request->isMethod('POST')) {
            $this->addFlash(
                'notice',
                'Membre bien enregistré.'
            );

//            return $this->redirectToRoute('digitar_assurex_view', array('id' => $advert->getId()));
        }

        return $this->render('DigitarAssurexBundle:Member:add.html.twig');


//        // Création de l'entité
//        $member = new Member();
//        $member->setName('Stephan.');
//        $member->setGsm('04659865');
//        $member->setMail("msteph@gmail.com");
//        $birth = new DateTime();
//        $birth->sub(new DateInterval('P20Y'));
//        var_dump($birth);
//        $member->setBirthday($birth);
//        // On peut ne pas définir le statut ,
//        // car ces attributs sont définis automatiquement dans le constructeur
//
//
//        // Création d'une première candidature
//        $transaction1 = new Transaction();
//        $transaction1->setDate(new DateTime());
//        $transaction1->getDescription("maDscr");
//        $transaction1->setCommunication("maComm");
//        $transaction1->setMontant("200");
//
//
//        $transaction1->setMember($member);
//
//        // On récupère l'EntityManager
//        $em = $this->getDoctrine()->getManager();
//
//        // Étape 1 : On « persiste » l'entité
//        /**
//         * L'étape 1 dit à Doctrine de « persister » l'entité.
//         * Cela veut dire qu'à partir de maintenant cette entité
//         * (qui n'est qu'un simple objet !) est gérée par Doctrine.
//         * Cela n'exécute pas encore de requête SQL, ni rien d'autre.
//         */
//        $em->persist($member);
//        $em->persist($transaction1);
//
//        // Étape 2 : On « flush » tout ce qui a été persisté avant
//        /**
//         * L'étape 2 dit à Doctrine d'exécuter effectivement les requêtes nécessaires
//         * pour sauvegarder les entités qu'on lui a dit de persister précédemment
//         * (il fait donc desINSERT INTO  & Cie) ;
//         */
//        $em->flush();
//
//        /**
//         * TRAITEMENT SERVICE STAFF
//         */
//        // On récupère le service
////        $antimineur = $this->container->get('digitar_assurex.antimineur');
////
////        // Je pars du principe que $text contient le texte d'un message quelconque
////        //$date = new DateTime();
////        $date = date('Y-m-d', strtotime('-20 years'));
////
////
////        if ($antimineur->isMineur($date)) {
////            throw new \Exception('Le membre a ete detecté comme mineur !');
////        }
//
//        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
//        if ($request->isMethod('POST')) {
//            // Ici, on s'occupera de la création et de la gestion du formulaire
//            $this->addFlash(
//                'notice',
//                'Membre bien enregistré.'
//            );
//
//            // Puis on redirige vers la page de visualisation de ce membre
//            /**
//             * notre Member étant maintenant enregistré en base de données grâce au flush(),
//             * Doctrine2 lui a attribué un id ! On peut donc utiliser$member2->getId()
//             * dans la génération de la route, et non un nombre fixe comme précédemment.
//             */
//            return $this->redirectToRoute('digitar_assurex_view', array('id' => $member->getId()));
//        }
//
//        // Si on n'est pas en POST, alors on affiche le formulaire
//        return $this->render('DigitarAssurexBundle:Member:add.html.twig', array('member2' => $member));
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $member = $em->getRepository('DigitarAssurexBundle:Member')->find($id);

        if (null === $member) {
            throw new NotFoundHttpException("Le membre d'id ".$id." n'existe pas.");
        }

        // Ici encore, il faudra mettre la gestion du formulaire

        if ($request->isMethod('POST')) {
            $this->addFlash(
                'notice',
                'Membre bien modifié.'
            );

            return $this->redirectToRoute('digitar_assurex_view', array('id' => $member->getId()));
        }

        return $this->render('DigitarAssurexBundle:Member:edit.html.twig', array(
            'member' => $member
        ));

//        // Ici, on récupérera le membre correspondant à $id
//        $member = array(
//            'id'   => 1,
//            'name'      => 'Louis philippe',
//            'gsm'      => '0465985632',
//            'mail'      => 'lphilippe@gmail.com',
//            'date'    => new \Datetime());
//        // Même mécanisme que pour l'ajout
//        if ($request->isMethod('POST')) {
//            $this->addFlash(
//                'notice',
//                'membre bien modifié.'
//            );
//
//            return $this->redirectToRoute('digitar_assurex_view', array('id' => 5));
//        }
//
//        return $this->render('DigitarAssurexBundle:Member:edit.html.twig', array('member' => $member));
    }

    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $member = $em->getRepository('DigitarAssurexBundle:Member')->find($id);

        if (null === $member) {
            throw new NotFoundHttpException("Le membre d'id ".$id." n'existe pas.");
        }

        // On boucle sur les catégories de l'annonce pour les supprimer
        foreach ($member->getTransactions() as $transaction) {
            $member->removeTransaction($transaction);
        }

        $em->flush();

        return $this->render('DigitarAssurexBundle:Member:delete.html.twig');

//        return $this->render('DigitarAssurexBundle:Member:delete.html.twig');
    }

    public function menuAction($limit)
    {

        $em = $this->getDoctrine()->getManager();

        $listMembers = $em->getRepository('DigitarAssurexBundle:Member')->findBy(
            array(),                 // Pas de critère
            array('birthday' => 'desc'), // On trie par date décroissante
            $limit,                  // On sélectionne $limit annonces
            0                        // À partir du premier
        );

        return $this->render('DigitarAssurexBundle:Member:menu.html.twig', array(
            'listMembers' => $listMembers
        ));
//
//        // On fixe en dur une liste ici, bien entendu par la suite
//        // on la récupérera depuis la BDD !
//        $listMembers = array(
//            array('id' => 2, 'name' => 'Jean luc'),
//            array('id' => 5, 'name' => 'Louis philippe'),
//            array('id' => 9, 'name' => 'Bertrand')
//        );
//
//        return $this->render('DigitarAssurexBundle:Member:menu.html.twig', array(
//            // Tout l'intérêt est ici : le contrôleur passe
//            // les variables nécessaires au template !
//            'listMembers' => $listMembers
//        ));
    }
}