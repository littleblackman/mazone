<?php

declare(strict_types=1);

namespace App\Responder\Cart;

use App\Responder\Cart\Interfaces\ShowResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowResponder implements ShowResponderInterface
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($name, $data): Response
    {
        return new Response(
            $this->twig->render($name, $data)
        );
    }
}