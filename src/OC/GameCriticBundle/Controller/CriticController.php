<?php

namespace OC\GameCriticBundle\Controller;

use OC\GameCriticBundle\Entity\Critic;
use OC\GameCriticBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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

    /**
     * Report critic.
     * 
     * @Security("has_role('ROLE_USER')")
     */
    public function reportAction(Critic $critic, Request $request, SessionInterface $session)
    {
        // Check in user session if this critic is already reported
        $criticsIdReported = $session->get('criticsIdReported', []);
        if (in_array($critic->getId(), $criticsIdReported)) {
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(['message' => 'Signalement déjà effectué.']);
            } else {
                $request->getSession()->getFlashBag()->add('success', 'Signalement déjà effectué.');
    
                return $this->redirectToRoute('game_show', ['id' => $critic->getGame()->getId(), 'slug' => $critic->getGame()->getSlug()]);
            }
        }
        array_push($criticsIdReported, $critic->getId());
        $session->set('criticsIdReported', $criticsIdReported);
        
        // Increment critic report counter
        $em = $this->getDoctrine()->getManager();
        $critic->setReportCounter($critic->getReportCounter() + 1);
        $em->persist($critic);
        $em->flush();

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(['message' => 'Signalement bien effectué.']);
        } else {
            $request->getSession()->getFlashBag()->add('success', 'Signalement bien effectué.');

            return $this->redirectToRoute('game_show', ['id' => $critic->getGame()->getId(), 'slug' => $critic->getGame()->getSlug()]);
        }
    }
}
