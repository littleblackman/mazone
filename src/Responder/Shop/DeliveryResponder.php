<?php

declare(strict_types=1);

namespace App\Responder\Shop;

use App\Responder\Shop\Interfaces\DeliveryResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DeliveryResponder implements DeliveryResponderInterface
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