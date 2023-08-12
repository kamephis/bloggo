<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout() : RedirectResponse
    {
        return $this->redirectToRoute('app_homepage');
    }
}
