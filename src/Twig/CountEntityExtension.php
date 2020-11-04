<?php

namespace App\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class CountEntityExtension extends AbstractExtension
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('countEntity', [$this, 'countEntity']),
        ];
    }

    public function countEntity(string $entityClass)
    {
        return $this->entityManager->getRepository($entityClass)->countAll();
    }
}
