<?php

namespace OC\GameCriticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    public function listAction()
    {
        return $this->render('@OCGameCritic/Game/list.html.twig', [
            'page_title' => 'Liste des jeux'
        ]);
    }
}
