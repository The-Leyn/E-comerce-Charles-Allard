<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/histoire', name: 'app_history')]
    public function history(): Response
    {
        return $this->render('home/history.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/savoir-faire', name: 'app_knowledge')]
    public function knowledge(): Response
    {
        return $this->render('home/knowledge.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
