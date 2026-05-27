<?php

declare(strict_types=1);

namespace App\Command;

use App\Fixtures\FixturesLoaderInterface;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'doctrine:fixtures:load', description: 'Load academic e-commerce fixtures')]
final class DoctrineFixturesLoadCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly FixturesLoaderInterface $fixturesLoader,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Purge for a clean rerun during development.
        $output->writeln('Purging existing categories/products...');

        // Deleting children first satisfies FK constraints.
        $this->entityManager->createQuery('DELETE FROM App\\Entity\\Product p')->execute();
        $this->entityManager->createQuery('DELETE FROM App\\Entity\\Category c')->execute();

        $output->writeln('Loading fixtures...');
        $this->fixturesLoader->load($this->entityManager);

        $output->writeln('Fixtures loaded.');

        return Command::SUCCESS;
    }
}

