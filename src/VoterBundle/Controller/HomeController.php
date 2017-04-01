<?php

namespace VoterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;

use VoterBundle\Entity\User;

class HomeController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function homeAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $form = $this->container->get('voter.create')->voterCreate($request, $this->getUser());
            if ($form instanceof FormInterface) {
                return $this->render('VoterBundle:Main:main.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }

    }

}