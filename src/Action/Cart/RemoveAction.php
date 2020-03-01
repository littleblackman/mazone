<?php

declare(strict_types=1);

namespace App\Action\Cart;

use App\Action\Cart\Interfaces\RemoveActionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Service\CartManagerService;
use App\Responder\Cart\Interfaces\RemoveResponderInterface;

/**
 * @Route(path="/removeFromCart/{productId}", name="removeFromCart")
 */
class RemoveAction implements RemoveActionInterface
{
    private $responder;
    private $cartManagerService;
    
    public function __construct(RemoveResponderInterface $responder, CartManagerService $cartManagerService)
    {
        $this->responder = $responder;
        $this->cartManagerService = $cartManagerService;
    }

    public function __invoke($productId)
    {
        $data = $this->cartManagerService->removeFromCart($productId);
        return $this->responder->render($data);
    }
}