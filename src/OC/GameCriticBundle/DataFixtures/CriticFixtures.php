<?php
namespace OC\GameCriticBundle\DataFixtures;

use OC\GameCriticBundle\Entity\Critic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CriticFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $criticsData = [
            [
                'score' => '9',
                'content' => "C'est un excellent jeu !",
            ],
            [
                'score' => '7',
                'content' => "C'est un bon jeu !",
            ],
            [
                'score' => '5',
                'content' => "C'est un jeu moyen !",
            ],
        ];

        foreach ($criticsData as $data) {
            $critic = new Critic();
            $critic->setScore($data['score']);
            $critic->setContent($data['content']);
            $critic->setCreationDate(new \DateTime());
            $critic->setGame($this->getReference(GameFixtures::GOW_GAME_REFERENCE));
            $manager->persist($critic);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            GameFixtures::class,
        );
    }
}