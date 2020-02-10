<?php

declare(strict_types=1);

namespace App\Responder\Home;

use App\Responder\Home\Interfaces\HomeResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeResponder implements HomeResponderInterface
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