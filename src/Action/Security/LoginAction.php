<?php

declare(strict_types=1);

namespace App\Action\Security;

use App\Action\Security\Interfaces\LoginActionInterface;
use App\Domain\Service\ShopConfigurationService;
use App\Responder\Security\Interfaces\LoginResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route(path="/azma-connexion", name="login")
 */
class LoginAction implements LoginActionInterface
{
    private $responder;
    private $shopConfigurationService;

    public function __construct(LoginResponderInterface $responder, AuthenticationUtils $authenticationUtils,ShopConfigurationService $shopConfigurationService)
    {
        $this->responder = $responder;
        $this->shopConfigurationService = $shopConfigurationService;
        $this->authenticationUtils = $authenticationUtils;
    }

    public function __invoke()
    {

        $config = $this->shopConfigurationService->retrieveMenuElements();

        $error = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();


        return $this->responder->render('security/login.html.twig', [
                                                                   'config'  => $config,
                                                                   'last_username' => $lastUsername,
                                                                   'error' => $error
                                                                ]);
    }
}