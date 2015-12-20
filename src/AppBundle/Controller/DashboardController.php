<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="_dashboard")
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user=="anon.") {return $this->redirect($this->generateUrl('fos_user_security_login'));}
        $projects = $this->getDoctrine()->getRepository('AppBundle:Projects')->findAll();
        return $this->render('AppBundle:Dashboard:index.html.twig', [
            "projects" => $projects
        ]);
    }
}