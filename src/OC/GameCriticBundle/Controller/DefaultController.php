<?php

namespace OC\GameCriticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@OCGameCritic/Default/index.html.twig');
    }
}
