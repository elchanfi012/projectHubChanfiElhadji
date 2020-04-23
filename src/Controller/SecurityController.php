<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {

            $manager = $this->getUser();
            $lastLogin = new DateTime();
            $manager->setLastLogin($lastLogin);


            $this->getDoctrine()->getManager()->persist($manager);
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('projects');
        }

        

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
       // return new RedirectResponse($this->urlGenerator->generate('app_login'));
       throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
