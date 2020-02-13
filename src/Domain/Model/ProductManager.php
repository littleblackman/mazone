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

    public function getBestSolded($limit) {
        $products = $this->em->getRepository(Product::class)->findBy([], array('solded' => 'DESC'),$limit);
        return $products;
    }

    public function getBrandsArray() {
        $results = $this->em->getRepository(Product::class)->getBrandsArray();
        return $results;
    }

    public function getBestSoldedBySubCategory($category, $limit = 4) {
        if(!$category->getChilds()) return null;
        foreach($category->getChilds() as $cat) {
            $products = $this->em->getRepository(Product::class)->findBy(['category' => $cat], array('solded' => 'DESC'), $limit);
            $datas[$cat->getName()] = $products;
        }
        return $datas;
    }

    public function getBestLikedProducts($limit = 6) {
        $products = $this->em->getRepository(Product::class)->findBy([], array('liked' => 'DESC'), $limit);
        return $products;

    }

}