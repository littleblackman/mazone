<?php

declare(strict_types=1);

namespace App\Responder\Cart;

use App\Domain\Service\CartManagerService;
use App\Responder\Cart\Interfaces\AddResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddResponder implements AddResponderInterface
{

    private $cartManagerService;

    public function __construct(CartManagerService $cartManagerService){
        $this->cartManagerService = $cartManagerService;
    }

    public function render($cart): Response
    {
        $cartArray = $this->cartManagerService->toArray();
        return new JsonResponse($cartArray);
    }
}