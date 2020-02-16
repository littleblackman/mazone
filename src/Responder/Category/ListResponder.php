<?php

declare(strict_types=1);

namespace App\Responder\Category;

use App\Responder\Category\Interfaces\ListResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListResponder implements ListResponderInterface
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