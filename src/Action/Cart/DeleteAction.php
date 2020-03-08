<?php

declare(strict_types=1);

namespace App\Action\Cart;

use App\Action\Cart\Interfaces\DeleteActionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartManagerService;
use App\Responder\Cart\Interfaces\DeleteResponderInterface;


/**
 * @Route(path="/vider-votre-panier/", name="deleteCart")
 */
class DeleteAction implements DeleteActionInterface
{
    private $cartManagerService;
    private $responder;


    public function __construct(CartManagerService $cartManagerService, DeleteResponderInterface $responder)
    {
        $this->cartManagerService = $cartManagerService;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $this->cartManagerService->delete();
        return $this->responder->render();
    }
}