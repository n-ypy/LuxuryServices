<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;

class LoginController extends AbstractController
{
    use ResetPasswordControllerTrait;

    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, Session $session): Response
    {
        if (null === ($resetToken = $this->getTokenObjectFromSession())) {
            $resetToken = null;
        }

        $session->remove('ResetPasswordToken');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error'         => $error,
            'resetToken' => $resetToken,
            'login' => true
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
    }
}
