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
        $member = array(
                'id'   => 1,
                'name'      => 'Louis philippe',
                'gsm'      => '0465985632',
                'mail'      => 'lphilippe@gmail.com',
                'date'    => new \Datetime());

        return $this->render('DigitarAssurexBundle:Member:view.html.twig', array(
            'member' => $member
        ));
    }

    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire
            $this->addFlash(
                'notice',
                'Membre bien enregistré.'
            );

            // Puis on redirige vers la page de visualisation de ce membre
            return $this->redirectToRoute('digitar_assurex_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('DigitarAssurexBundle:Member:add.html.twig');
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