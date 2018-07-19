<?php

namespace OC\GameCriticBundle\Controller;

use OC\GameCriticBundle\Entity\Critic;
use OC\GameCriticBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Critic controller.
 *
 */
class CriticController extends Controller
{
    /**
     * Creates a new critic entity.
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Game $game, Request $request)
    {
        $critic = new Critic();
        $critic->setGame($game);
        $critic->setUser($this->getUser());
        $form = $this->createForm('OC\GameCriticBundle\Form\FrontCriticType', $critic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($critic);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Critique bien enregistrée.');

            return $this->redirectToRoute('game_show', ['id' => $game->getId(), 'slug' => $game->getSlug()]);
        }

        return $this->render('@OCGameCritic/critic/new.html.twig', array(
            'critic' => $critic,
            'form' => $form->createView(),
            'game' => $game,
        ));
    }
}
