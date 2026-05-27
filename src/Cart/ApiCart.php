<?php

declare(strict_types=1);

namespace App\Cart;

use App\Entity\Product;

final class ApiCart implements CartInterface
{
    public function add(Product $product, int $quantity): void
    {
        dd('Stratégie API : Produit ajouté via une fausse API externe !', $product, $quantity);
    }

    public function getCart(): array
    {
        return [];
    }

    public function clear(): void
    {
        dd('Stratégie API : Panier vidé à distance !');
    }
}

