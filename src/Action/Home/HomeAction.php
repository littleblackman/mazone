<?php

declare(strict_types=1);

namespace App\Action\Home;

use App\Action\Home\Interfaces\HomeActionInterface;
use App\Responder\Home\Interfaces\HomeResponderInterface;
use App\Domain\Model\ProductManager;
use App\Domain\Model\CategoryManager;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Service\ShopConfigurationService;


/**
 * @Route(path="/", name="home")
 */
class HomeAction implements HomeActionInterface
{
    private $responder;
    private $shopConfigurationService;
    private $productManager;

    public function __construct(HomeResponderInterface $responder, ProductManager $productManager, ShopConfigurationService $shopConfigurationService)
    {
        $this->productManager           = $productManager;
        $this->shopConfigurationService = $shopConfigurationService;
        $this->responder                = $responder;
    }

    public function __invoke()
    {

        $config = $this->shopConfigurationService->retrieveMenuElements();
        $bests  = $this->productManager->getBestSolded(6);
     
        return $this->responder->render('home/index.html.twig', [
                                                                    'bests'  => $bests,
                                                                    'config' => $config
                                                                ]);
    }
}