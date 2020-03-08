<?php

declare(strict_types=1);

namespace App\Responder\Security;

use App\Responder\Security\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class RegisterResponder implements RegisterResponderInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(string $name, $data = []): Response
    {
        return new Response(
            $this->twig->render($name, $data)
        );
    }
}