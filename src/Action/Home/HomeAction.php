<?php

declare(strict_types=1);

namespace App\Action\Home;

use App\Action\Home\Interfaces\HomeActionInterface;
use App\Entity\Product;
use App\Responder\Home\Interfaces\HomeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(path="/", name="home")
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
    
        $product = new Product();

        return $this->responder->render('home/index.html.twig');
    }
}