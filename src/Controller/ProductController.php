<?php

namespace App\Controller;

use App\Entity\Product;
use App\Cart\CartHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly CartHandler $cartHandler,
    ) {
    }

    #[Route(
        '/product/{id}',
        name: 'app_product_details',
        requirements: ['id' => '\d+'],
        methods: ['GET', 'POST']
    )]
    public function details(Product $product, Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $quantity = $request->request->getInt('quantity', 1);
            $this->cartHandler->handleAdd($product, $quantity);

            $this->addFlash('success', 'Produit ajouté au panier avec succès !');

            return $this->redirectToRoute('app_product_details', ['id' => $product->getId()]);
        }

        return $this->render('ecommerce/product_details.html.twig', [
            'product' => $product,
        ]);
    }
}
