<?php

declare(strict_types=1);

namespace App\Action\Cart;

use App\Action\Cart\Interfaces\AddActionInterface;
use App\Domain\Model\ProductManager;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartManagerService;
use App\Responder\Cart\Interfaces\AddResponderInterface;

/**
 * @Route(path="/addToCart/{productId}", name="addToCart")
 */
class AddAction implements AddActionInterface
{
    private $responder;
    private $cartManagerService;
    private $productManager;
    
    public function __construct(AddResponderInterface $responder, CartManagerService $cartManagerService, ProductManager $productManager)
    {
        $this->responder = $responder;
        $this->cartManagerService = $cartManagerService;
        $this->productManager = $productManager;
    }

    public function __invoke($productId)
    {
        $this->cartManagerService->addToCart($productId);
        $product = $this->productManager->find($productId);
        return $this->responder->render($product);
    }
}