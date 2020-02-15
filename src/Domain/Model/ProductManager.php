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
    private $productRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
        $this->productRepository = $this->em->getRepository(Product::class);
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

    public function createSlug($name) {

        $slug_name = str_replace([' ', ',', "'"], ['-', '-', '-'], $name);
        $slug_name = strtolower(
                            str_replace(
                                ['é', 'è', 'ê', 'ï', 'î','ë', 'à', 'ô', 'ö', 'â'],
                                ['e', 'e', 'e', 'i', 'i', 'e', 'a', 'o', 'o', 'a'],
                                $slug_name
        ));

        $i = 0;

        $original_name = $slug_name;

        if($product = $this->productRepository->findOneBy(['slug' => $slug_name])) {

            $slug_product = $product->getSlug();
            while($slug_name == $slug_product) {
                $i++;
                $slug_name = $original_name.'-'.$i;
                $product = $this->productRepository->findOneBy(['slug' => $slug_name]);
                ($product) ? $slug_product = $product->getSlug() : $slug_product = "";
            }
        }

        return $slug_name;
    }

}