<?php
namespace OC\GameCriticBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use OC\GameCriticBundle\Entity\Critic;

class GameUpdaterSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
        );
    }
    
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->update($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->update($args);
    }

    public function update(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // If it's a Critic entity
        if ($entity instanceof Critic) {
            // Update game score
            $em = $args->getEntityManager();
            $game = $entity->getGame();
            $score = $em->getRepository('OCGameCriticBundle:Critic')->calulateScore($game);
            $game->setScore($score);
            $em->persist($game);
            $em->flush();
        }
    }
}