<?php

declare(strict_types=1);

namespace App\Action\Home;

use App\Action\Home\Interfaces\HomeActionInterface;
use App\Domain\Model\ProductManager;
use App\Responder\Home\Interfaces\HomeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Service\ShopConfigurationService;


/**
 * @Route(path="/", name="home")
 */
class HomeAction implements HomeActionInterface
{
    private $responder;

    public function __construct(HomeResponderInterface $responder, ProductManager $productManager, ShopConfigurationService $shopConfigurationService)
    {
        $this->productManager           = $productManager;
        $this->shopConfigurationService = $shopConfigurationService;
        $this->responder                = $responder;
    }

    public function __invoke()
    {
        $products  = $this->productManager->findBest();
        $menuItems = $this->shopConfigurationService->getMenuItems();
        $brands    = $this->shopConfigurationService->getMenuBrands();

        return $this->responder->render('home/index.html.twig', ['products' => $products, 'menuItems' => $menuItems, 'brands' => $brands]);
    }
}