<?php

declare(strict_types=1);

namespace App\Domain\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Entity\Category;

/**
 * Class used to manager all the shop application
 * 
 */
class ShopConfigurationService
{

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }


}