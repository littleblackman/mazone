<?php

declare(strict_types=1);

namespace App\Responder\Cart\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface AddResponderInterface
{
    public function render(array $cart): Response;
}