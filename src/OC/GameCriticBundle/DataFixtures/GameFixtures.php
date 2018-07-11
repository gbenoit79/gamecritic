<?php
namespace OC\GameCriticBundle\DataFixtures;

use OC\GameCriticBundle\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GameFixtures extends Fixture
{
    const GOW_GAME_REFERENCE = 'gow-game';
    
    public function load(ObjectManager $manager)
    {
        $gamesData = [
            [
                'name' => 'God of War',
                'description' => "Dans ce nouvel opus exploitant mythologie nordique, Kratos a enfin l’opportunité de canaliser la rage qui l'a si longtemps habité. Inquiet du sombre héritage qu'il a transmis à son fils, Kratos espère pouvoir réparer ses fautes et effacer les horreurs de son passé.",
                'score' => '8.5',
                'releaseDate' => new \DateTime('2018-04-20'),
            ],
            [
                'name' => 'Dark Souls : Remastered',
                'description' => "Version remastérisée du jeu d'aventure Dark Souls développé par From Software et sorti en 2011.",
                'score' => '8.4',
                'releaseDate' => new \DateTime('2018-05-25'),
            ],
            [
                'name' => 'Dragon Ball FighterZ',
                'description' => "Dragon Ball FighterZ est un jeu de combat 2D développé par Arc System Works et édité par Bandai Namco. Cette nouvelle adaptation de la franchise Dragon Ball met en scène les personnages iconiques de la série dans des affrontements explosifs en 3 versus 3.",
                'score' => '7.9',
                'releaseDate' => new \DateTime('2018-01-26'),
            ],
        ];

        foreach ($gamesData as $data) {
            $game = new Game();
            $game->setName($data['name']);
            $game->setDescription($data['description']);
            $game->setScore($data['score']);
            $game->setReleaseDate($data['releaseDate']);
            $manager->persist($game);
            $manager->flush();

            if ($game->getName() === 'God of War') {
                $this->addReference(self::GOW_GAME_REFERENCE, $game);
            }
        }
    }
}