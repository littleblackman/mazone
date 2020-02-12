<?php

declare(strict_types=1);

namespace App\Action\Home;

use App\Action\Home\Interfaces\HomeActionInterface;
use App\Domain\Model\ProductManager;
use App\Domain\Model\CategoryManager;
use App\Responder\Home\Interfaces\HomeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Service\ShopConfigurationService;


/**
 * @Route(path="/", name="home")
 */
class HomeAction implements HomeActionInterface
{
    private $responder;

    public function __construct(HomeResponderInterface $responder, ProductManager $productManager, CategoryManager $categoryManager, ShopConfigurationService $shopConfigurationService)
    {
        $this->productManager           = $productManager;
        $this->shopConfigurationService = $shopConfigurationService;
        $this->responder                = $responder;
        $this->categoryManager          = $categoryManager;
    }

    public function __invoke()
    {
        $bests     = $this->productManager->bestSolded(6);
        $brands    = $this->productManager->getBrandsArray();
        $menuItems = $this->categoryManager->getMenuItems();

        return $this->responder->render('home/index.html.twig', ['bests' => $bests, 'menuItems' => $menuItems, 'brands' => $brands]);
    }
}