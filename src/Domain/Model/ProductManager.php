<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Entity\Product;
use App\Domain\Model\baseModelManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class used to manager Product
 * 
 */
class ProductManager extends baseModelManager
{

    private $em;
    private $productRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
        $this->productRepository = $this->em->getRepository(Product::class);
    }

    public function getManagerRepository() {
        return $this->productRepository;
    }

    public function getBestSolded($limit) {
        $products = $this->productRepository->findBy([], array('solded' => 'DESC'),$limit);
        return $products;
    }

    public function getBrandsArray() {
        $results = $this->productRepository->getBrandsArray();
        return $results;
    }

    public function getBestSoldedBySubCategory($category, $limit = 4) {
        if(!$category->getChilds()) return null;
        foreach($category->getChilds() as $cat) {
            $products = $this->productRepository->findBy(['category' => $cat], array('solded' => 'DESC'), $limit);
            $datas[$cat->getName()] = $products;
        }
        return $datas;
    }

    public function findBySlug($slug) {
        return $this->productRepository->findOneBy(['slug' => $slug]);
    }

    public function getBestLikedProducts($limit = 6) {
        $products = $this->productRepository->findBy([], array('liked' => 'DESC'), $limit);
        return $products;

    }
}