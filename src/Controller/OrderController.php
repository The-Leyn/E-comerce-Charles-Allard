<?php

namespace App\Controller;

use Stripe\Webhook;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Stripe\Exception\SignatureVerificationException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order/create', name: 'app_order_create')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        // Si l'utilisateur n'est pas connecté redirige vers la page de connexion.
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        // Création du formulaire
        // $form = $this->createForm(OrderType::class, null, [
        //     'user' => $this->getUser()
        // ]);

        //Récupération du panier
        $cart = $session->get('cart', []);
        $data = [];

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);

            $data[] = [
                'product' => $product,
                'quantity' =>  $quantity
            ];
        }
        // dd($data);
        if (empty($data)) {
            return $this->redirectToRoute('app_product');
        }
        return $this->render('order/index.html.twig', [
            // Je retourne le formulaire à la vue
            // 'form' => $form->createView(),
            'data' => $data
        ]);
    }

    #[Route('/order/create-session-stripe', name: 'app_order_create_session_stripe')]
    public function stripeCheckout(SessionInterface $session, ProductRepository $productRepository): RedirectResponse
    {
        \Stripe\Stripe::setApiKey('sk_test_51P2clnRsb96WtGtNw33kguEYbuAf2aL1sYuHp0NPhNpd429Pp8TTXsG5vaVCUIDqxgsgbWK6hjjJQ5XUZLGy4lGM00ATIegRQs');
        $session->set('payment_process_in_progress', true);


        //Récupération du panier
        $cart = $session->get('cart', []);
        $data = [];

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);

            $priceWithPromotion = $product->getPriceWithPromotion();

            $data[] = [
                'product' => $product,
                'quantity' =>  $quantity,
                'priceWithPromotion' => $priceWithPromotion,
            ];
        }
        $productStripe = [];
        foreach ($data as $productItem) {
            $productStripe[] = [
                'price_data' => [
                    'currency' => 'EUR',
                    'unit_amount' => (int) (floatval(str_replace(',', '', $productItem['priceWithPromotion'])) * 100),
                    'product_data' => [
                        'name' => $productItem['product']->getName(),
                    ]
                ],
                'quantity' => $productItem['quantity'],
            ];
        }
        // dd($productStripe);
        // dd($data);

        $checkout_session = \Stripe\Checkout\Session::create([
            #ifndef __INTELLISENSE__
            'customer_email' => $this->getUser()->getEmail(),
            #endif
            'line_items' => [[
                $productStripe
            ]],
            'metadata' => [
                'user_id' => $this->getUser()->getId(), // Utilisez ici l'identifiant de l'utilisateur
            ],
            'mode' => 'payment',
            'shipping_address_collection' => ['allowed_countries' => ['FR']],
            'success_url' => $this->generateUrl('app_order_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_order_error', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return new RedirectResponse($checkout_session->url);
    }

    #[Route('/order/success', name: 'app_order_success')]
    public function stripeSuccess(SessionInterface $session): Response
    {
        if (!$session->get('payment_process_in_progress')) {
            // Redirect the user to another page if they are not engaged in a payment process
            return $this->redirectToRoute('app_home');
        }
        return $this->render('order/success.html.twig', []);
    }
    #[Route('/order/error', name: 'app_order_error')]
    public function stripeError(SessionInterface $session): Response
    {
        if (!$session->get('payment_process_in_progress')) {
            // Redirect the user to another page if they are not engaged in a payment process
            return $this->redirectToRoute('app_home');
        }
        return $this->render('order/error.html.twig', []);
    }

    #[Route('/order/webhook', name: 'webhook')]
    public function stripeWebHook(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le payload et la signature depuis la requête
        $payload = $request->getContent();
        $sigHeader = $request->headers->get('Stripe-Signature');

        // Votre secret de webhook Stripe
        $endpointSecret = 'whsec_1cd14f6cc77db66af332f68d85f44a18f641cb7dca947b2a5bf524b0633824ae';

        $user = $this->getUser();

        try {
            // Vérifier la signature de la requête
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

            // Gérer l'événement en fonction de son type
            switch ($event->type) {
                case 'checkout.session.completed':
                    // Gérer l'événement de session de paiement terminée
                    $sessionStripe = $event->data->object;

                    $user = $entityManager->getRepository(User::class)->find($sessionStripe->metadata->user_id);

                    // Créer une nouvelle instance de l'entité Order
                    $order = new Order();

                    // Enregistrer les détails de la commande
                    $order->setUser($user);
                    $order->setCreatedAt(new \DateTimeImmutable());
                    $order->setOrderTotal($sessionStripe->amount_total / 100);
                    $order->setCurrency($sessionStripe->currency);
                    $order->setName($sessionStripe->shipping_details->name);
                    $order->setCity($sessionStripe->shipping_details->address->city);
                    $order->setCountry($sessionStripe->shipping_details->address->country);
                    $order->setAddressLine1($sessionStripe->shipping_details->address->line1);
                    $order->setAddressLine2($sessionStripe->shipping_details->address->line2);
                    $order->setPostalCode($sessionStripe->shipping_details->address->postal_code);
                    $order->setPaymentIntentId($sessionStripe->payment_intent);

                    // Enregistrement de l'Order dans la base de données au prochain flush().
                    $entityManager->persist($order);

                    // Affichage des infos dans un fichier JSON pour visualiser les informations récupérer par la requette
                    // json_encode($sessionStripe);
                    // file_put_contents('test_Stripe_Checkout_completed.json', $sessionStripe);


                    // Requette à l'API Stripe pour récupérer les produits de la commande
                    $stripe = new \Stripe\StripeClient('sk_test_51P2clnRsb96WtGtNw33kguEYbuAf2aL1sYuHp0NPhNpd429Pp8TTXsG5vaVCUIDqxgsgbWK6hjjJQ5XUZLGy4lGM00ATIegRQs');
                    $lineItems =  $stripe->checkout->sessions->allLineItems($sessionStripe->id);

                    // Pour chaque produit de la commande création dans la base de donné d'un OrderItem lié à l'Order créer plus haut.
                    foreach ($lineItems as $lineItem) {
                        $orderItem = new OrderItem();

                        $orderItem->setOrderReference($order);
                        $orderItem->setName($lineItem->description);
                        $orderItem->setItemPrice($lineItem->amount_total / 100);
                        $orderItem->setQuantity($lineItem->quantity);

                        // Enregistrement de l'OrderItem dans la base de données lors du prochain flush().
                        $entityManager->persist($orderItem);
                    }

                    // Enregistrez tous les changements dans la base de données
                    $entityManager->flush();

                    // Affichage des infos dans un fichier JSON pour visualiser les informations récupérer par la requette
                    // json_encode($lineItems);
                    // file_put_contents('test_lineItems_Stripe_Checkout_completed.json', $lineItems);



                    // Votre logique de gestion d'événement ici
                    break;
                    // Ajouter d'autres cas pour gérer différents types d'événements
                default:
                    return new Response('Received unknown event type ' . $event->type);
            }
        } catch (SignatureVerificationException $e) {
            // Erreur de vérification de la signature
            return new Response(null, 400);
        } catch (\UnexpectedValueException $e) {
            // Erreur de payload invalide
            return new Response(null, 400);
        }

        // Répondre avec un code de statut 200 pour indiquer que le traitement s'est déroulé avec succès
        return new Response(null, 200);
    }
}
