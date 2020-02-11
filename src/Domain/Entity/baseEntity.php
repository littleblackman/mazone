<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class baseEntity
 * Add commons methods to all entities
 *
 * @package App\Domain\Entity
 */
class baseEntity
{
    public function getName() {
        return $this->getNameFr();
    }

}
