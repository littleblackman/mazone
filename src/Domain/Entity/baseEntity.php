<?php

namespace App\Domain\Entity;

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

    public function getDescription() {
        return $this->getDescriptionFr();
    }

}
