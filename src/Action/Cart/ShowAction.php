<?php

declare(strict_types=1);

namespace App\Action\Cart;

use App\Action\Cart\Interfaces\ShowActionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartManagerService;
use App\Responder\Cart\Interfaces\ShowResponderInterface;
use App\Service\ShopConfigurationService;


/**
 * @Route(path="/votre-panier/", name="showCart")
 */
class ShowAction implements ShowActionInterface
{
    private $responder;
    private $cartManagerService;
    private $shopConfigurationService;

    public function __construct(ShowResponderInterface $responder, CartManagerService $cartManagerService, ShopConfigurationService $shopConfigurationService)
    {
        $this->responder = $responder;
        $this->cartManagerService = $cartManagerService;
        $this->shopConfigurationService = $shopConfigurationService;
    }

    public function __invoke()
    {
        $cart = $this->cartManagerService->getCart();
        $config = $this->shopConfigurationService->retrieveMenuElements();

        return $this->responder->render('cart/show.html.twig', ['cart' => $cart, 'config' => $config]);


    }
}