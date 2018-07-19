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
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus est fermentum, dictum erat sed, dignissim mi. Etiam feugiat nulla quis facilisis viverra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque eu lorem quis urna lacinia fermentum. Donec malesuada ullamcorper luctus. Nunc ac dapibus felis. Duis ornare vel neque non consequat. Nulla sit amet leo eget velit dapibus pretium.",
            ],
            [
                'score' => '8',
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin purus quis mattis eleifend. Curabitur at elit metus. Aliquam molestie ullamcorper elit eu maximus. Donec vitae nisi urna. Sed id est est. Vestibulum pretium consectetur velit, ut ullamcorper mi viverra ac. Quisque tempor laoreet turpis, et aliquam nisl suscipit aliquam.",
            ],
            [
                'score' => '7',
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in faucibus ante, sed finibus erat. Nunc condimentum magna ac vehicula molestie. Fusce eu lacus euismod, tempus massa sit amet, fringilla sem. Integer volutpat tincidunt eleifend. Mauris finibus feugiat tortor, et tristique tortor mattis et. Mauris sed dictum nisl. Quisque efficitur est id odio convallis, malesuada fringilla sem posuere. Integer semper mattis massa, vitae venenatis ante semper eu. Mauris ut nibh neque. Sed tristique maximus nibh. Nunc non libero scelerisque, tempus sapien non, aliquam nulla. Morbi consectetur efficitur ultricies. In ullamcorper ornare odio, vel congue sem hendrerit a. Quisque a elit in orci ultrices dignissim.",
            ],
            [
                'score' => '5',
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam odio sem, ultricies eget velit nec, malesuada vehicula ante. Nam quis massa a nunc mattis hendrerit vel sed mi. Duis vitae posuere lectus, ut vehicula sem. Duis sapien mauris, rhoncus non fringilla ac, tincidunt vitae dolor. Duis id mi commodo, eleifend diam eu, tincidunt ligula. Phasellus laoreet sagittis sapien a pulvinar. Maecenas arcu eros, varius et vestibulum sit amet, placerat quis nisl. Suspendisse commodo laoreet sem quis sagittis. Ut elementum ut nisi ac sagittis. In at ipsum quis sem dignissim dignissim.",
            ],
        ];

        foreach ($criticsData as $data) {
            $critic = new Critic();
            $critic->setScore($data['score']);
            $critic->setContent($data['content']);
            $critic->setCreationDate(new \DateTime());
            $critic->setGame($this->getReference('god-of-war-game'));
            $critic->setUser($this->getReference(UserFixtures::GUILLAUME_USER_REFERENCE));
            $manager->persist($critic);
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