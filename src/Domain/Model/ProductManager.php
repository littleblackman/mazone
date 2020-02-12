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

    public function bestSolded($limit) {
        $products = $this->em->getRepository(Product::class)->findBy([], array('solded' => 'DESC'),$limit);
        return $products;
    }

    public function getBrandsArray() {
        $results = $this->em->getRepository(Product::class)->getBrandsArray();
        return $results;
    }
}