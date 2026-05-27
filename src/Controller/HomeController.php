<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly ProductRepository $productRepository,
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $products = $this->productRepository->findAllOrderedByTop();

        return $this->render('ecommerce/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/categories', name: 'app_categories')]
    public function browseCategories(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('ecommerce/browse_categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{id}', name: 'app_products_by_category', requirements: ['id' => '\d+'])]
    public function productsByCategory(Category $category): Response
    {
        return $this->render('ecommerce/products_by_category.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/panier', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('ecommerce/cart.html.twig');
    }
}
