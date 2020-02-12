<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
    * @return Product[] Returns an array of brands 
    */
    public function getBrandsArray()
    {
        return  $this->createQueryBuilder('p')
                ->select('count(p.brand) AS quantity, p.brand as name')
                ->orderBy('p.brand', 'ASC')
                ->groupBy('p.brand')
                ->getQuery()
                ->getResult();       
        
    }
}
