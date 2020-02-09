<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class used to manager Product
 * 
 */
class ProductManager
{

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function findBest() {
        $products = $this->em->getRepository(Product::class)->findAll();
        return $products;
    }
}