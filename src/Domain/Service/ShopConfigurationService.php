<?php

declare(strict_types=1);

namespace App\Domain\Service;

use Doctrine\ORM\EntityManagerInterface;

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

    public function getMenuItems() {
        
        $menuItems = [
                        "Informatique" => ['Ordinateur', 'Disque dur', 'Téléphone'],
                        "Audiovisuel" => ['Télévision', 'Musique', 'Jeux vidéo', 'Cinéma'],
                        "Vêtement" => [],
                        "Maison & Déco" => ['Jardin', 'Salon']
        ];

        return $menuItems;
    }

    public function getMenuBrands() {
        $menuBrands = [ "Apple" => 76, "Xiaomi" => 65, "D&G" => 28, "Nintendo" => 54 ];
        return $menuBrands;
    }

}