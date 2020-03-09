<?php

namespace App\Domain\Entity;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;



/**
 * Class baseEntity
 * Add commons methods to all entities
 *
 * @package App\Domain\Entity
 */
abstract class baseEntity
{
    protected $formFactory;
    protected $request;

    public function getName() {
        return $this->getNameFr();
    }

    public function getDescription() {
        return $this->getDescriptionFr();
    }

    public function getInformation() {
        return $this->getInformationFr();
    }

    public function initForm()
    {
        $this->formFactory = Forms::createFormFactory();
        $this->request = Request::createFromGlobals();   

    }


}
