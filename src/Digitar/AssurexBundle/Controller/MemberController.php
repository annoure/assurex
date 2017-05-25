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
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    // La route fait appel à DigitarAssurexBundle:Member:view,
    // on doit donc définir la méthode viewAction.
    // On donne à cette méthode l'argument $id, pour
    // correspondre au paramètre {id} de la route
        public function viewAction($id)
        {
            // $id vaut 5 si l'on a appelé l'URL /assurex/member/5

            // Ici, on récupèrera depuis la base de données
            // l'annonce correspondant à l'id $id.
            // Puis on passera l'annonce à la vue pour
            // qu'elle puisse l'afficher

            return new Response("Affichage du membre d'id : ".$id);
        }

    // On récupère tous les paramètres en arguments de la méthode
    public function viewSlugAction($slug, $year, $format)
    {
        //Cette route intercepte par exemple les URL suivantes :/assurex/2011/webmaster-aguerri.html
        // et /platform/2012/symfony.xml
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }

    public function indexAction()
    {
        $content = $this->get('templating')->render('DigitarAssurexBundle:Member:index.html.twig');

        return new Response($content);
    }
}