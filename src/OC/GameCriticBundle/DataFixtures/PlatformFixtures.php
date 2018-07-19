<?php
namespace OC\GameCriticBundle\DataFixtures;

use OC\GameCriticBundle\Entity\Platform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlatformFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $platformsData = [
            [
                'name' => 'PC',
                'slug' => 'pc',
            ],
            [
                'name' => 'PlayStation 4',
                'slug' => 'playstation-4',
            ],
            [
                'name' => 'Switch',
                'slug' => 'switch',
            ],
            [
                'name' => 'Xbox One',
                'slug' => 'xbox-one',
            ],
            [
                'name' => 'PlayStation 3',
                'slug' => 'playstation-3',
            ],
            [
                'name' => 'Wii U',
                'slug' => 'wii-u',
            ],
        ];

        foreach ($platformsData as $data) {
            $platform = new Platform();
            $platform->setName($data['name']);

            $this->addReference($data['slug'].'-platform', $platform);

            $manager->persist($platform);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            GameFixtures::class,
        );
    }
}