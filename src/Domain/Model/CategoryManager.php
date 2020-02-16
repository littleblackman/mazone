<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Model\baseModelManagers;

/**
 * Class used to manager Product
 * 
 */
class CategoryManager extends baseModelManager
{

    private $em;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
        $this->categoryRepository = $this->em->getRepository(Category::class);
    }

    public function getManagerRepository() {
        return $this->categoryRepository;
    }
    public function getMenuItems() {
        $categories = $this->categoryRepository->findBy(['parent' => null], array('nameFr' => 'ASC'));

        foreach($categories as $category) {
            $category->setChilds($this->getSubCategories($category));
            $datas[] = $category;
        }

        return $datas;
    }

    public function getSubCategories($category, $subOrder = 'nameFr') {
        if(!$subcats = $this->categoryRepository->findBy(['parent' => $category], array($subOrder => 'ASC'))) return null;
        return $subcats;

    }

    public function findBySlug($slug) {
        return $this->categoryRepository->findOneBy(['slug' => $slug]);
    }

    public function getCategoryByConstantKey($constant_key, $subCategories = true, $subOrder = 'nameFr') {
        if(!$category = $this->categoryRepository->findOneBy(['constantKey' => $constant_key])) return null;
        if($subCategories) {
            $category->setChilds($this->getSubCategories($category, $subOrder));
        }
        return $category;
    }

    public function getCategoryBySlug($slug_name, $subCategories = true, $subOrder = 'nameFr') {
        if(!$category = $this->categoryRepository->findOneBy(['slug' => $slug_name])) return null;
        if($subCategories) {
            $category->setChilds($this->getSubCategories($category, $subOrder));
        }
        return $category;
    }


}