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
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Ici, on récupérera la liste des membres, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template
        return $this->render('DigitarAssurexBundle:Member:view.html.twig');
    }

    public function viewAction($id)
    {
        // Ici, on récupérera le membre correspondant à l'id $id

        return $this->render('DigitarAssurexBundle:Member:view.html.twig', array(
            'id' => $id
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
            $request->getSession()->getFlashBag()->add('notice', 'Membre bien enregistré.');

            // Puis on redirige vers la page de visualisation de ce membre
            return $this->redirectToRoute('digitar_assurex_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('DigitarAssurexBundle:Member:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera le membre correspondant à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $this->addFlash(
                'notice',
                'membre bien modifié.'
            );

            return $this->redirectToRoute('digitar_assurex_view', array('id' => 5));
        }

        return $this->render('DigitarAssurexBundle:Member:edit.html.twig');
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera le membre correspondant à $id

        // Ici, on gérera la suppression du membre en question

        return $this->render('DigitarAssurexBundle:Member:delete.html.twig');
    }


//
//
//    // La route fait appel à DigitarAssurexBundle:Member:view,
//    // on doit donc définir la méthode viewAction.
//    // On donne à cette méthode l'argument $id, pour
//    // correspondre au paramètre {id} de la route
////        public function viewAction($id)
////        {
////            // $id vaut 5 si l'on a appelé l'URL /assurex/member/5
////
////            // Ici, on récupèrera depuis la base de données
////            // l'annonce correspondant à l'id $id.
////            // Puis on passera l'annonce à la vue pour
////            // qu'elle puisse l'afficher
////
////            return new Response("Affichage du membre d'id : ".$id);
////        }
//    public function viewAction($id, Request $request)
//    {
//        return $this->render('DigitarAssurexBundle:Member:view.html.twig', array(
//            'id' => $id
//        ));
//    }
//
//    // On récupère tous les paramètres en arguments de la méthode
//    public function viewSlugAction($slug, $year, $format)
//    {
//        //Cette route intercepte par exemple les URL suivantes :/assurex/2011/webmaster-aguerri.html
//        // et /platform/2012/symfony.xml
//        return new Response(
//            "On pourrait afficher l'annonce correspondant au
//            slug '".$slug."', créée en ".$year." et au format ".$format."."
//        );
//    }
//
//    public function indexAction()
//    {
//        $content = $this->get('templating')->render('view.html.twig');
//
//        return new Response($content);
//    }
//
//    // Ajoutez cette méthode :
//    public function addAction(Request $request)
//    {
//        $this->addFlash(
//            'notice',
//            'Your changes were saved!'
//        );
//        // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()
//
//        // Puis on redirige vers la page de visualisation de cette annonce
//        return $this->redirectToRoute('digitar_assurex_view', array('id' => 5));
//    }

}