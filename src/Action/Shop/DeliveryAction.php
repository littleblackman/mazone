<?php

declare(strict_types=1);

namespace App\Action\Shop;

use App\Action\Shop\Interfaces\DeliveryActionInterface;
use App\Responder\Shop\Interfaces\DeliveryResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(path="/shop/livraison", name="shopDelivery")
 */
class DeliveryAction implements DeliveryActionInterface
{
    private $responder;

    public function __construct(DeliveryResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke()
    {
       
    
        return $this->responder->render('product/show.html.twig', [
                                                                ]);
    }
}