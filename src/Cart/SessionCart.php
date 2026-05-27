<?php

declare(strict_types=1);

namespace App\Cart;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\RequestStack;

final class SessionCart implements CartInterface
{
    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    public function add(Product $product, int $quantity): void
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);

        $productId = $product->getId();
        if ($productId === null) {
            return;
        }

        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        $session->set('cart', $cart);
    }

    public function getCart(): array
    {
        return $this->requestStack->getSession()->get('cart', []);
    }

    public function clear(): void
    {
        $this->requestStack->getSession()->remove('cart');
    }
}

