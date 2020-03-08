<?php

declare(strict_types=1);

namespace App\Responder\Security\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface RegisterResponderInterface
{
    public function render(string $name, array $data = []): Response;
}