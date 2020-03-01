<?php

declare(strict_types=1);

namespace App\Responder\Cart;

use App\Responder\Cart\Interfaces\RemoveResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class RemoveResponder implements RemoveResponderInterface
{

    public function render($data): JsonResponse
    {
        return new JsonResponse($data);
    }
}