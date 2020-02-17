<?php

declare(strict_types=1);

namespace App\Responder\Cart\Interfaces;

use Symfony\Component\HttpFoundation\JsonResponse;

interface AddResponderInterface
{
    public function render(array $cart): JsonResponse;
}