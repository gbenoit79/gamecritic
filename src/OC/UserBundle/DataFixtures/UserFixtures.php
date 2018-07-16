<?php
namespace OC\UserBundle\DataFixtures;

use OC\UserBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $usersData = [
            [
                'username' => 'guillaume',
                'password' => 'userpass',
                'roles' => ['ROLE_USER'],
            ],
            [
                'username' => 'antoine',
                'password' => 'userpass',
                'roles' => ['ROLE_USER'],
            ],
            [
                'username' => 'didier',
                'password' => 'userpass',
                'roles' => ['ROLE_USER'],
            ],
            [
                'username' => 'admin',
                'password' => 'adminpass',
                'roles' => ['ROLE_ADMIN'],
            ],
        ];

        foreach ($usersData as $data) {
            $user = new User;
            $user->setUsername($data['username']);
            $user->setPassword($data['password']);
            $user->setSalt('');
            $user->setRoles($data['roles']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}