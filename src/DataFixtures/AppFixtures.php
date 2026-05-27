<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Fixtures\FixturesLoaderInterface;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures implements FixturesLoaderInterface
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'imageUrl' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=700&q=80',
                'products' => [
                [
                    'name' => 'Wireless Headphones',
                    'description' => 'Premium wireless headphones with active noise cancellation, 30-hour battery life, and crystal-clear sound quality.',
                    'price' => 79.99,
                    'imageUrl' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&q=80',
                    'isTop' => true,
                ],
                [
                    'name' => 'Bluetooth Speaker',
                    'description' => 'Portable Bluetooth speaker with rich bass and 12-hour battery life.',
                    'price' => 59.99,
                    'imageUrl' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500&q=80',
                    'isTop' => false,
                ],
                ],
            ],
            [
                'name' => 'Fashion',
                'imageUrl' => 'https://images.unsplash.com/photo-1520975693411-b4fdb5d1b3a5?w=700&q=80',
                'products' => [
                [
                    'name' => 'Classic Leather Jacket',
                    'description' => 'Timeless leather jacket crafted from premium materials for everyday wear.',
                    'price' => 149.99,
                    'imageUrl' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=500&q=80',
                    'isTop' => true,
                ],
                ],
            ],
            [
                'name' => 'Home & Garden',
                'imageUrl' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=700&q=80',
                'products' => [
                [
                    'name' => 'Smart Plant Sensor',
                    'description' => 'Monitor soil moisture, light, and temperature to keep your plants healthy.',
                    'price' => 34.99,
                    'imageUrl' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=500&q=80',
                    'isTop' => false,
                ],
                ],
            ],
            [
                'name' => 'Sports',
                'imageUrl' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=700&q=80',
                'products' => [
                [
                    'name' => 'Yoga Mat Premium',
                    'description' => 'Non-slip yoga mat with extra cushioning for comfort during workouts.',
                    'price' => 29.99,
                    'imageUrl' => 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=500&q=80',
                    'isTop' => true,
                ],
                ],
            ],
            [
                'name' => 'Books',
                'imageUrl' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?w=700&q=80',
                'products' => [
                [
                    'name' => 'Web Development Guide',
                    'description' => 'A comprehensive guide to modern web development with PHP and Symfony.',
                    'price' => 24.99,
                    'imageUrl' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500&q=80',
                    'isTop' => false,
                ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = (new Category())
                ->setName($categoryData['name'])
                ->setImageUrl($categoryData['imageUrl']);
            $manager->persist($category);

            foreach ($categoryData['products'] as $productData) {
                $product = (new Product())
                    ->setName($productData['name'])
                    ->setDescription($productData['description'])
                    ->setPrice($productData['price'])
                    ->setImageUrl($productData['imageUrl'])
                    ->setIsTop((bool) ($productData['isTop'] ?? false))
                    ->setCategory($category);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
