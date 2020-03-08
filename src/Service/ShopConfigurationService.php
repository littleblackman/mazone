<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Model\CategoryManager;
use App\Domain\Model\ProductManager;
use App\Service\CartManagerService;

/**
 * Class used to manager all the shop application
 * 
 */
class ShopConfigurationService
{

    private $productManager;
    private $categoryManager;
    private $cartManagerService;

    public function __construct(ProductManager $productManager, CategoryManager $categoryManager, CartManagerService $cartManagerService) {
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
        $this->cartManagerService = $cartManagerService;
    }


    public function retrieveMenuElements() {
        $elements['brands']          = $this->productManager->getBrandsArray();
        $elements['menuItems']       = $this->categoryManager->getMenuItems();
        $elements['topCategory']     = $this->categoryManager->getCategoryByConstantKey('CLOTHES', true, 'id');
        $elements['topProducts']     = $this->productManager->getBestSoldedBySubCategory($elements['topCategory'] );
        $elements['topLikeProducts'] = $this->productManager->getBestLikedProducts();
        $elements['cartNbItems']     = $this->cartManagerService->getCartNbItems();

        return $elements;
    }

}