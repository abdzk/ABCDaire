<?php

namespace App\Controller;

use App\Entity\ABCD;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */

    public function home() {
        return $this->render("main/home.html.twig");
    }

}