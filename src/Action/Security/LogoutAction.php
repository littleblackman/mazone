<?php

declare(strict_types=1);

namespace App\Action\Security;

use App\Action\Security\Interfaces\LogoutActionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/logout", name="logout")
 */
class LogoutAction implements LogoutActionInterface
{
   
    public function __invoke()
    {

    }
}