<?php

declare(strict_types=1);

namespace App\Action\Product;

use App\Action\Product\Interfaces\ProductShowActionInterface;
use App\Domain\Model\ProductManager;
use App\Domain\Service\ShopConfigurationService;
use App\Responder\Product\Interfaces\ProductShowResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(path="/decouvrez/{slug}", name="showProduct")
 */
class ProductShowAction implements ProductShowActionInterface
{
    private $responder;
    private $productManager;
    private $shopConfigurationService;

    public function __construct(ProductShowResponderInterface $responder, ProductManager $productManager, ShopConfigurationService $shopConfigurationService)
    {
        $this->responder = $responder;
        $this->productManager = $productManager; 
        $this->shopConfigurationService = $shopConfigurationService;
    }

    public function __invoke($slug)
    {
        $product = $this->productManager->findBySlug($slug);
        $config = $this->shopConfigurationService->retrieveMenuElements();
        
        return $this->responder->render('product/show.html.twig', [
                                                                   'product' => $product,
                                                                   'config'  => $config
                                                                ]);
    }
}