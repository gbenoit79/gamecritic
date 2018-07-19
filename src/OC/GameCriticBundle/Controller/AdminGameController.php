<?php

namespace OC\GameCriticBundle\Controller;

use OC\GameCriticBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin game controller.
 *
 */
class AdminGameController extends Controller
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

        return $this->render('@OCGameCritic/admin/game/index.html.twig', array(
            'games' => $games,
            'pagination' => [
                'nbPages' => $nbPages,
                'page' => $page,
                'path' => 'admin_game_index'
            ],
        ));
    }

    /**
     * Creates a new game entity.
     * 
     */
    public function newAction(Request $request)
    {
        $game = new Game();
        $form = $this->createForm('OC\GameCriticBundle\Form\GameType', $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le jeu a bien été ajouté.');

            return $this->redirectToRoute('admin_game_index');
        }

        return $this->render('@OCGameCritic/admin/game/new.html.twig', array(
            'game' => $game,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing game entity.
     *
     */
    public function editAction(Request $request, Game $game)
    {
        $editForm = $this->createForm('OC\GameCriticBundle\Form\GameType', $game);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le jeu a bien été modifié.');

            return $this->redirectToRoute('admin_game_edit', array('id' => $game->getId()));
        }

        return $this->render('@OCGameCritic/admin/game/edit.html.twig', array(
            'game' => $game,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a game entity.
     * 
     */
    public function deleteAction(Request $request, Game $game)
    {   
        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($game);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le jeu a bien été supprimé.');
            return $this->redirectToRoute('admin_game_index');
        }
        
        return $this->render('@OCGameCritic/admin/game/delete.html.twig', array(
            'game' => $game,
            'form'   => $form->createView(),
        ));
    }
}
