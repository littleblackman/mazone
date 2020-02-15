<?php

declare(strict_types=1);

namespace App\Responder\Product;

use App\Responder\Product\Interfaces\ProductShowResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ProductShowResponder implements ProductShowResponderInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(string $name, $data): Response
    {
        return new Response(
            $this->twig->render($name, $data)
        );
    }
}