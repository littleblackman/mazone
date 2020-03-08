<?php

declare(strict_types=1);

namespace App\Responder\Shop\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface DeliveryResponderInterface
{
    public function render(string $name, array $data): Response;
}