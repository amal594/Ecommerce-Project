<?php

declare(strict_types=1);

namespace App\Cart;

use App\Entity\Product;

interface CartInterface
{
    /**
     * Ajoute un produit au panier avec une certaine quantité
     */
    public function add(Product $product, int $quantity): void;

    /**
     * Récupère le contenu actuel du panier
     *
     * @return array<int, int> [productId => quantity]
     */
    public function getCart(): array;

    /**
     * Vide complètement le panier
     */
    public function clear(): void;
}

