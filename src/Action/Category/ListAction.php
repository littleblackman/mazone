<?php

declare(strict_types=1);

namespace App\Action\Category;

use App\Action\Category\Interfaces\ListActionInterface;
use App\Domain\Service\ShopConfigurationService;
use App\Responder\Category\Interfaces\ListResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Model\ProductManager;
use App\Domain\Model\CategoryManager;


/**
 * @Route(path="/liste/{slug}", name="listCategory")
 */
class ListAction implements ListActionInterface
{
    private $responder;
    private $shopConfigurationService;
    private $productManager;
    private $categoryManager;

    public function __construct(ListResponderInterface $responder, ProductManager $productManager, CategoryManager $categoryManager, ShopConfigurationService $shopConfigurationService)
    {
        $this->responder = $responder;
        $this->shopConfigurationService = $shopConfigurationService;
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
    }

    public function __invoke($slug)
    {
        $config = $this->shopConfigurationService->retrieveMenuElements();
        $category = $this->categoryManager->findBySlug($slug);
        $products = $this->productManager->findByCategorySlug($slug);
        
        return $this->responder->render('category/list.html.twig', [
                                                                   'config'   => $config,
                                                                   'products' => $products,
                                                                   'category' => $category
                                                                ]);
    }
}