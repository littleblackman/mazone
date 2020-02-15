<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Model\CategoryManager;
use App\Domain\Model\ProductManager;

/**
 * Class used to manager all the shop application
 * 
 */
class ShopConfigurationService
{

    private $productManager;
    private $categoryManager;

    public function __construct(ProductManager $productManager, CategoryManager $categoryManager) {
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
    }


    public function retrieveMenuElements() {
        $elements['brands']          = $this->productManager->getBrandsArray();
        $elements['menuItems']       = $this->categoryManager->getMenuItems();
        $elements['topCategory']     = $this->categoryManager->getCategoryByConstantKey('CLOTHES', true, 'id');
        $elements['topProducts']     = $this->productManager->getBestSoldedBySubCategory($elements['topCategory'] );
        $elements['topLikeProducts'] = $this->productManager->getBestLikedProducts();

        return $elements;
    }

}