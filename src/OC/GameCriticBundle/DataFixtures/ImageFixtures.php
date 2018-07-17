<?php
namespace OC\GameCriticBundle\DataFixtures;

use OC\GameCriticBundle\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $imagesData = [
            [
                'filename' => 'dark-souls-remastered.jpg',
            ],
            [
                'filename' => 'dragon-ball-fighterz.jpg',
            ],
            [
                'filename' => 'god-of-war.jpg',
            ],
            [
                'filename' => 'persona-5.jpg',
            ],
            [
                'filename' => 'the-legend-of-zelda-breath-of-the-wild.jpg',
            ],
        ];
        $imgPath = __DIR__.'/../../../../web/img/fixtures/';

        foreach ($imagesData as $data) {
            $image = new Image();
            copy($imgPath.$data['filename'], $imgPath.'copy-'.$data['filename']);
            $file = new UploadedFile($imgPath.'copy-'.$data['filename'], $data['filename'], null, null, null, true);
            $image->setFile($file);
            
            $this->addReference(pathinfo($data['filename'], PATHINFO_FILENAME).'-image', $image);
            
            $manager->persist($image);
        }

        $manager->flush();
    }
}