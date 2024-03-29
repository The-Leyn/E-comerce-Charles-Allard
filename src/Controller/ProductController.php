<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $repository): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $repository->findAll()
        ]);
    }
    #[Route('/product/{id}', name: 'app_product_show')]
    public function show(ProductRepository $repository, int $id): Response
    {
        // dd($id);
        return $this->render('product/show.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $repository->find($id)
        ]);
    }
}
