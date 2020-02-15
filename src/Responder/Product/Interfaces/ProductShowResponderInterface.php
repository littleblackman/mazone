<?php

declare(strict_types=1);

namespace App\Responder\Product\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface ProductShowResponderInterface
{
    public function render(string $name, array $data): Response;
}