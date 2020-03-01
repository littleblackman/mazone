<?php

declare(strict_types=1);

namespace App\Responder\Cart\Interfaces;

use Symfony\Component\HttpFoundation\JsonResponse;

interface RemoveResponderInterface
{
    public function render(array $data): JsonResponse;
}