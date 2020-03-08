<?php

declare(strict_types=1);

namespace App\Action\Security;

use App\Action\Security\Interfaces\RegisterActionInterface;
use App\Service\ShopConfigurationService;
use App\Responder\Security\Interfaces\LoginResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\RegisterService;



/**
 * @Route(path="/creer-son-profil", name="register")
 */
class RegisterAction implements RegisterActionInterface
{
    private $responder;
    private $shopConfigurationService;
    private $registerService;


    public function __construct(LoginResponderInterface $responder, ShopConfigurationService $shopConfigurationService, RegisterService $registerService)
    {
        $this->responder = $responder;
        $this->shopConfigurationService = $shopConfigurationService;
        $this->registerService = $registerService;
     
    }

    public function __invoke()
    {
        $config = $this->shopConfigurationService->retrieveMenuElements();
        $form = $this->registerService->createUserForm();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->registerService->submitForm($form);
            return $this->responder->render('login');
        }
        return $this->responder->render('security/register.html.twig', [
                                                                   'config'  => $config,
                                                                   'form' => $form->createView(),
                                                                ]);
    }
}