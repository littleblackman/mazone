<?php

declare(strict_types=1);

namespace App\Responder\Cart;

use App\Domain\Entity\Product;
use App\Responder\Cart\Interfaces\AddResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddResponder implements AddResponderInterface
{

    public function render($product): JsonResponse
    {
        return new JsonResponse($product->toArray());
    }
}