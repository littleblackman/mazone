<?php

declare(strict_types=1);

namespace App\Action\Cart;

use App\Action\Cart\Interfaces\AddActionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Service\CartManagerService;
use App\Responder\Cart\Interfaces\AddResponderInterface;

/**
 * @Route(path="/addToCart/{productId}", name="addToCart")
 */
class AddAction implements AddActionInterface
{
    private $responder;
    private $cartManagerService;
    public function __construct(AddResponderInterface $responder, CartManagerService $cartManagerService)
    {
        $this->responder = $responder;
        $this->cartManagerService = $cartManagerService;
    }

    public function __invoke($productId)
    {
        $cart = $this->cartManagerService->addToCart($productId);
        return $this->responder->render($cart);
    }
}