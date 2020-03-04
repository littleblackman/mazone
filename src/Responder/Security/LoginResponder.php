<?php

declare(strict_types=1);

namespace App\Responder\Security;

use App\Responder\Security\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class LoginResponder implements LoginResponderInterface
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