<?php

declare(strict_types=1);

namespace App\Responder\Category\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface ListResponderInterface
{
    public function render(string $name, array $data): Response;
}