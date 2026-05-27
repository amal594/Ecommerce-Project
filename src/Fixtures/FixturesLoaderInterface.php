<?php

declare(strict_types=1);

namespace App\Fixtures;

use Doctrine\Persistence\ObjectManager;

interface FixturesLoaderInterface
{
    public function load(ObjectManager $manager): void;
}

