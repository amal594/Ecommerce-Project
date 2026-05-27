<?php

declare(strict_types=1);

namespace App\Cart;

use App\Entity\Product;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class CartHandler
{
    public function __construct(
        // Changez ApiCart::class <-> SessionCart::class pour basculer.
        #[Autowire(service: SessionCart::class)]
        private readonly CartInterface $cartStrategy,
    ) {
    }

    public function handleAdd(Product $product, int $quantity): void
    {
        if ($quantity <= 0) {
            return;
        }

        $this->cartStrategy->add($product, $quantity);
    }

    public function getCartContent(): array
    {
        return $this->cartStrategy->getCart();
    }

    public function emptyCart(): void
    {
        $this->cartStrategy->clear();
    }
}

