<?php

namespace OC\GameCriticBundle\Controller;

use OC\GameCriticBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Game controller.
 *
 */
class GameController extends Controller
{
    /**
     * Lists all game entities.
     *
     */
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" not found');
        }

        $em = $this->getDoctrine()->getManager();
        $totalGames = $em->getRepository('OCGameCriticBundle:Game')->getTotalGames();
        if ($totalGames > 0) {
            $nbPerPage = $this->container->getParameter('nb_per_page');
            $nbPages = (int) ceil($totalGames / $nbPerPage);
            if ($page > $nbPages) {
                throw $this->createNotFoundException("Page ".$page." does not exist");
            }
            $games = $em->getRepository('OCGameCriticBundle:Game')->getLatestGames($page, $nbPerPage);
        } else {
            $games = [];
            $nbPages = 0;
        }

        return $this->render('@OCGameCritic/game/index.html.twig', array(
            'games' => $games,
            'pagination' => [
                'nbPages' => $nbPages,
                'page' => $page,
                'path' => 'oc_game_critic_homepage',
            ],
        ));
    }

    /**
     * Finds and displays a game entity.
     *
     */
    public function showAction(Game $game, $page)
    {   
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" not found');
        }
        
        $em = $this->getDoctrine()->getManager();
        $totalCritics = $em->getRepository('OCGameCriticBundle:Critic')->getTotalCriticsByGame($game);
        if ($totalCritics > 0) {
            $nbPerPage = $this->container->getParameter('nb_per_page');
            $nbPages = (int) ceil($totalCritics / $nbPerPage);
            if ($page > $nbPages) {
                throw $this->createNotFoundException("Page ".$page." does not exist");
            }
            $critics = $em->getRepository('OCGameCriticBundle:Critic')->getLatestCriticsByGame($game, $page, $nbPerPage);
        } else {
            $critics = [];
            $nbPages = 0;
        }

        return $this->render('@OCGameCritic/game/show.html.twig', array(
            'critics' => $critics,
            'game' => $game,
            'pagination' => [
                'nbPages' => $nbPages,
                'page' => $page,
                'path' => 'game_show',
                'pathParams' => [
                    'id' => $game->getId(),
                    'slug' => $game->getSlug(),
                ],
            ],
        ));
    }
}
