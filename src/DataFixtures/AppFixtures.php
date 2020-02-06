<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Message;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i =1; $i <=3; $i ++){
            $utilisateur = new User;

            $utilisateur -> setUsername('Utilisateur' . $i);
            $utilisateur -> setPhoto('Photo'. $i);
            $utilisateur -> setPassword('123456');
            $utilisateur -> setEmail('user' . $i . '@gmail.com');
            $utilisateur -> setGroupe('Nom du groupe');
            $utilisateur -> setMessages('Nombre de messages');
            $manager -> persist($utilisateur);
        }

        $manager->flush();

        for($j = 1;$j <= 20; $j++){
            $messages = new Message;

            $messages -> setUser(1);
            $messages -> setContent('Lorem ipsum dolor sit amet');
            $messages -> setState('state' . rand(0,3));
            $messages -> setDateTime(new \dateTime('now'));
            $manager -> persist($messages);            
        }

        $manager->flush();
    }
}
