<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

   /**
    * @Route("/")
    */
    public function index()
    {
        return $this->render('home/index.html.twig', []);
    }
}