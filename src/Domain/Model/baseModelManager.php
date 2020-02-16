<?php

namespace App\Domain\Model;

/**
 * Class baseModelManager
 * Add commons methods to all manager
 *
 * @package App\Domain\Model
 */
abstract class baseModelManager
{

    abstract public function getManagerRepository();

    public function createSlug($name) {

        $slug_name = str_replace([' ', ',', "'"], ['-', '-', '-'], $name);
        $slug_name = strtolower(
                            str_replace(
                                ['é', 'è', 'ê', 'ï', 'î','ë', 'à', 'ô', 'ö', 'â', 'ç'],
                                ['e', 'e', 'e', 'i', 'i', 'e', 'a', 'o', 'o', 'a', 'c'],
                                $slug_name
        ));

        $i = 0;

        $original_name = $slug_name;

        if($object = $this->getManagerRepository()->findOneBy(['slug' => $slug_name])) {

            $slug_object = $object->getSlug();
            while($slug_name == $slug_object) {
                $i++;
                $slug_name = $original_name.'-'.$i;
                $object = $this->getManagerRepository()->findOneBy(['slug' => $slug_name]);
                ($object) ? $slug_object = $object->getSlug() : $slug_object = "";
            }
        }

        return $slug_name;
    }
}