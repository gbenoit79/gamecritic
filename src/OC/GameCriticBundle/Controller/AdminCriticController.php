<?php

namespace OC\GameCriticBundle\Controller;

use OC\GameCriticBundle\Entity\Critic;
use OC\GameCriticBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin critic controller.
 *
 */
class AdminCriticController extends Controller
{
    /**
     * Lists all critic entities.
     *
     */
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" not found');
        }

        $em = $this->getDoctrine()->getManager();
        $totalCritics = $em->getRepository('OCGameCriticBundle:Critic')->getTotalCritics();
        if ($totalCritics > 0) {
            $nbPerPage = $this->container->getParameter('nb_per_page');
            $nbPages = (int) ceil($totalCritics / $nbPerPage);
            if ($page > $nbPages) {
                throw $this->createNotFoundException("Page ".$page." does not exist");
            }
            $critics = $em->getRepository('OCGameCriticBundle:Critic')->getLatestCritics($page, $nbPerPage);
        } else {
            $critics = [];
            $nbPages = 0;
        }

        return $this->render('@OCGameCritic/admin/critic/index.html.twig', array(
            'critics' => $critics,
            'pagination' => [
                'nbPages' => $nbPages,
                'page' => $page,
                'path' => 'admin_critic_index'
            ],
        ));
    }

    /**
     * Creates a new critic entity.
     * 
     */
    public function newAction(Request $request)
    {
        $critic = new Critic();
        $form = $this->createForm('OC\GameCriticBundle\Form\CriticType', $critic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($critic);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'La critique a bien été ajoutée.');

            return $this->redirectToRoute('admin_critic_index');
        }

        return $this->render('@OCGameCritic/admin/critic/new.html.twig', array(
            'critic' => $critic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing critic entity.
     *
     */
    public function editAction(Request $request, Critic $critic)
    {
        $editForm = $this->createForm('OC\GameCriticBundle\Form\CriticType', $critic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $request->getSession()->getFlashBag()->add('success', 'La critique a bien été modifiée.');

            return $this->redirectToRoute('admin_critic_edit', array('id' => $critic->getId()));
        }

        return $this->render('@OCGameCritic/admin/critic/edit.html.twig', array(
            'critic' => $critic,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a critic entity.
     * 
     */
    public function deleteAction(Request $request, Critic $critic)
    {   
        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($critic);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La critique a bien été supprimée.');
            return $this->redirectToRoute('admin_critic_index');
        }
        
        return $this->render('@OCGameCritic/admin/critic/delete.html.twig', array(
            'critic' => $critic,
            'form'   => $form->createView(),
        ));
    }
}
