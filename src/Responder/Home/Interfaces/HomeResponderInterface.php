<?php

declare(strict_types=1);

namespace App\Responder\Home\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface HomeResponderInterface
{
    public function render(string $name): Response;
}