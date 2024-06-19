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
    #[Route('/collections', name: 'app_collections')]
    public function collection(): Response
    {
        return $this->render('home/collections.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/legal-mention', name: 'app_legal_mention')]
    public function mentionLegale(): Response
    {
        return $this->render('home/legal/legal.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/privacy-policy', name: 'app_privacy_policy')]
    public function privacyPolicy(): Response
    {
        return $this->render('home/legal/privacy.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/sales-conditions', name: 'app_sales_conditions')]
    public function salesCondition(): Response
    {
        return $this->render('home/legal/sales.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/terms-conditions', name: 'app_terms_conditions')]
    public function termsCondition(): Response
    {
        return $this->render('home/legal/terms.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
}
