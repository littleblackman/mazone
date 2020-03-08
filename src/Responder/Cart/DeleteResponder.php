<?php

declare(strict_types=1);

namespace App\Responder\Cart;

use App\Responder\Cart\Interfaces\DeleteResponderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Responder\baseResponder;

class DeleteResponder extends baseResponder implements DeleteResponderInterface
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function render()
    {
        return $this->redirectToRoute('home');
    }

}