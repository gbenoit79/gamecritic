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
                'email' => 'guillaume@gmail.com',
                'password' => 'userpass',
                'roles' => ['ROLE_USER'],
            ],
            [
                'username' => 'antoine',
                'email' => 'antoine@gmail.com',
                'password' => 'userpass',
                'roles' => ['ROLE_USER'],
            ],
            [
                'username' => 'didier',
                'email' => 'didier@gmail.com',
                'password' => 'userpass',
                'roles' => ['ROLE_USER'],
            ],
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'adminpass',
                'roles' => ['ROLE_ADMIN'],
            ],
        ];

        foreach ($usersData as $data) {
            $user = new User;
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPlainPassword($data['password']);
            $user->setRoles($data['roles']);
            $user->setEnabled(true);
            $manager->persist($user);
        }

        $manager->flush();
    }
}