<?php

namespace App\Service\Security;

use App\Domain\Entity\baseEntity;
use App\Domain\Entity\User;
use App\Domain\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegisterService extends baseEntity
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
       $this->initForm();
       $this->passwordEncoder = $passwordEncoder;
    }


    public function createUserForm() {

        $user = new User();
        $form = $this->formFactory->create(RegisterType::class, $user);
        $form->handleRequest($this->request);

        if($this->request->isMethod('POST')) {
            $user = $this->register($form);
            return $user;
        }

        return $form;
    }

    /*
    public function register($form) {
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $data = $form->getData();
            $email = $data->getEmail();
            $em->persist($data);
            $em->flush();
            $this->addFlash('success', 'Votre compte à bien été enregistré !');
        }

        return ['message' => 'user is persisted'];

    }*/
}
