<?php
namespace OC\GameCriticBundle\DataFixtures;

use OC\GameCriticBundle\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GameFixtures extends Fixture
{    
    public function load(ObjectManager $manager)
    {
        $gamesData = [
            [
                'name' => 'Dark Souls : Remastered',
                'description' => "Version remastérisée du jeu d'aventure Dark Souls développé par From Software et sorti en 2011.",
                'score' => '8.4',
                'platforms' => [
                    'pc',
                    'playstation-4',
                    'xbox-one',
                    'switch'
                ],
                'releaseDate' => new \DateTime('2018-05-25'),
                'slug' => 'dark-souls-remastered',
            ],
            [
                'name' => 'Dragon Ball FighterZ',
                'description' => "Dragon Ball FighterZ est un jeu de combat 2D développé par Arc System Works et édité par Bandai Namco. Cette nouvelle adaptation de la franchise Dragon Ball met en scène les personnages iconiques de la série dans des affrontements explosifs en 3 versus 3.",
                'score' => '7.9',
                'platforms' => [
                    'pc',
                    'playstation-4',
                    'xbox-one',
                    'switch'
                ],
                'releaseDate' => new \DateTime('2018-01-26'),
                'slug' => 'dragon-ball-fighterz',
            ],
            [
                'name' => 'God of War',
                'description' => "Dans ce nouvel opus exploitant mythologie nordique, Kratos a enfin l’opportunité de canaliser la rage qui l'a si longtemps habité. Inquiet du sombre héritage qu'il a transmis à son fils, Kratos espère pouvoir réparer ses fautes et effacer les horreurs de son passé.",
                'score' => '8.5',
                'platforms' => [
                    'playstation-4',
                ],
                'releaseDate' => new \DateTime('2018-04-20'),
                'slug' => 'god-of-war',
            ],
            [
                'name' => 'Persona 5',
                'description' => "Dans Persona 5, le joueur incarne un étudiant fraîchement transféré au lycée Shujin de Tokyo. Au cours de l'année scolaire, lui et ses camarades deviendront des justiciers masqués, surnommés les \"Phantom Thieves\". A vous de combattre l'injustice avec style, tout en gérant votre emploi du temps.",
                'score' => '8.9',
                'platforms' => [
                    'playstation-3',
                    'playstation-4',
                ],
                'releaseDate' => new \DateTime('2017-04-04'),
                'slug' => 'persona-5',
            ],
            [
                'name' => 'The Legend of Zelda : Breath of the Wild',
                'description' => "Après un long sommeil, Link se réveille seul dans un monde qu'il ne reconnaît pas. Il devra explorer un territoire aussi vaste que dangereux afin de retrouver la mémoire. En quête de réponses, il devra se servir de tout ce qui se trouve sur sa route pour survivre.",
                'score' => '8.9',
                'platforms' => [
                    'switch',
                    'wii-u',
                ],
                'releaseDate' => new \DateTime('2017-03-03'),
                'slug' => 'the-legend-of-zelda-breath-of-the-wild',
            ],
        ];

        foreach ($gamesData as $data) {
            $game = new Game();
            $game->setName($data['name']);
            $game->setDescription($data['description']);
            $game->setScore($data['score']);
            $game->setReleaseDate($data['releaseDate']);
            $game->setImage($this->getReference($data['slug'].'-image'));

            foreach ($data['platforms'] as $platform) {
                $game->addPlatform($this->getReference($platform.'-platform'));
            }

            $this->addReference($data['slug'].'-game', $game);

            $manager->persist($game);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ImageFixtures::class,
            PlatformFixtures::class,
        );
    }
}