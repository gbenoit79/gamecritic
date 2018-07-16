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
            [
                'name' => 'Persona 5',
                'description' => "Dans Persona 5, le joueur incarne un étudiant fraîchement transféré au lycée Shujin de Tokyo. Au cours de l'année scolaire, lui et ses camarades deviendront des justiciers masqués, surnommés les \"Phantom Thieves\". A vous de combattre l'injustice avec style, tout en gérant votre emploi du temps.",
                'score' => '8.9',
                'releaseDate' => new \DateTime('2017-04-04'),
            ],
            [
                'name' => 'The Legend of Zelda : Breath of the Wild',
                'description' => "Après un long sommeil, Link se réveille seul dans un monde qu'il ne reconnaît pas. Il devra explorer un territoire aussi vaste que dangereux afin de retrouver la mémoire. En quête de réponses, il devra se servir de tout ce qui se trouve sur sa route pour survivre.",
                'score' => '8.9',
                'releaseDate' => new \DateTime('2017-03-03'),
            ],
        ];

        foreach ($gamesData as $data) {
            $game = new Game();
            $game->setName($data['name']);
            $game->setDescription($data['description']);
            $game->setScore($data['score']);
            $game->setReleaseDate($data['releaseDate']);
            $manager->persist($game);

            if ($game->getName() === 'God of War') {
                $this->addReference(self::GOW_GAME_REFERENCE, $game);
            }
        }

        $manager->flush();
    }
}