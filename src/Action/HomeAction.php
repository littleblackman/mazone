<?php

declare(strict_types=1);

namespace App\Action;

use App\Action\Interfaces\HomeActionInterface;
use App\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/")
 */
class HomeAction implements HomeActionInterface
{
    private $responder;

    public function __construct(HomeResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke()
    {
        return $this->responder->render('home/index.html.twig');
    }
}