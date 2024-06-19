<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $repository, Request $request, SerializerInterface $serializer): Response
    {
        // Si l'url contient le paramètre ajax
        if($request->get('ajax')) {
            
            $content = $request->getContent();

        // Décoder le contenu JSON en tableau PHP
        $filters = json_decode($content, true);

            // dd($filters);

            $filteredProducts = $repository->findByFilters($filters);
            $numberOfProducts = count($filteredProducts);
           // Retourne la vue twig qui contient la bloucle pour les produits
           return new JsonResponse(
            $this->renderView('product/componant.html.twig', [
                'controller_name' => 'ProductController',
                'products' => $filteredProducts,
                'productsCount' => $numberOfProducts,// products contient désormais les produits filtrées
            ])
           );

        }
        $count = 2;
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $repository->findAll(),
            'productsCount' => $count
        ]);
    }
    #[Route('/product/{id}', name: 'app_product_show')]
    public function show(ProductRepository $repository, int $id): Response
    {
        return $this->render('product/show.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $repository->find($id)
        ]);
    }
}