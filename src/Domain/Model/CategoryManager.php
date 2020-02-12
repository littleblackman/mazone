<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class used to manager Product
 * 
 */
class CategoryManager
{

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getMenuItems() {
        $categories = $this->em->getRepository(Category::class)->findBy(['parent' => null], array('nameFr' => 'ASC'));

        foreach($categories as $category) {
            
            $subcats = $this->em->getRepository(Category::class)->findBy(['parent' => $category], array('nameFr' => 'ASC'));
            $category->setChilds($subcats);
            $datas[] = $category;

        }

        return $datas;
    }
}