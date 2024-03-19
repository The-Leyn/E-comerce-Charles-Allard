<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SliderRepository $repository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'sliders' => $repository->findAll()

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
