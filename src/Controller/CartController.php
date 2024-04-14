<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cart', name: 'app_cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        // Récupère le panier existant

        $cart = $session->get('cart', []);
        // $session->set('cart' ,[]); // Retire tous les articles du panier
        
        // On initialise des variables

        $data = [];

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);

            $data[] = [
                'product' => $product,
                'quantity' =>  $quantity
            ];
        }
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'data' => $data
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Product $product, SessionInterface $session, int $id) //: Response
    {
        // Récupère le panier existant

        $cart = $session->get('cart', []);

        // On ajoute le produit dans le panier s'il n'y est pas encore. Sinon on incrémente sa quantité
        if (empty($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }

        // On ajoute la varible panier dans la session
        $session->set('cart', $cart);

        // On redirige vers la page du panier
        return $this->redirectToRoute('app_cart_index');
        // dd($session);
    }
    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Product $product, SessionInterface $session, int $id) //: Response
    {
        // Récupère le panier existant

        $cart = $session->get('cart', []);
        // On retire le produit du le panier s'il n'y qu'1 exemplaire sinon on décrémente sa quantité
        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }
        // dd($session);

        // On ajoute la varible panier dans la session
        $session->set('cart', $cart);

        // On redirige vers la page du panier
        return $this->redirectToRoute('app_cart_index');
        // dd($session);
    }
}
