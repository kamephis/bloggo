<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CmsController extends AbstractController
{
    /**
     * @Route("/cms/{routeKey}", name="cms_show")
     */
    public function show(Request $request, string $routeKey): Response
    {
        $page = $this->getDoctrine()
            ->getRepository(Page::class)
            ->findOneBy(['routeKey' => $routeKey]);

        if (!$page) {
            throw $this->createNotFoundException('The page does not exist');
        }

        return $this->render('page/index.html.twig', [
            'page' => $page,
        ]);
    }

    public function editable(Request $request, string $routeKey): Response
    {
        // This is just a placeholder for the editable action you mentioned earlier.
        // You can implement the logic for editing the page here.
    }
}
