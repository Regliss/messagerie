<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Groupe;
use App\Entity\Message;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i =1; $i <=10; $i ++){
            $utilisateur = new User;

            $utilisateur -> setUsername('Utilisateur' . $i);
            $utilisateur -> setPhoto('Photo'. $i . '.jpg');
            $utilisateur -> setPassword('123456');
            $utilisateur -> setEmail('user' . $i . '@gmail.com');
            $manager -> persist($utilisateur);
        }

        $manager->flush();

        $repoUser = $manager -> getRepository(User::class);
        $users = $repoUser -> findAll();
        $nb = count($users);

        
        for($x = 1; $x <= 20; $x ++){

            $groupe = new Groupe; 

            $groupe -> setNom('Group test N°' . $x);
            $groupe -> setPhoto('photo_groupe' . $x . '.jpg');
            $groupe -> setDate(new \DateTime('now'));
            $groupe -> setUserAdmin($users[0]);
            $manager -> persist($groupe);
            
            for($z = 1; $z <= 4; $z++){
                $nbUser = rand(1, $nb-1);
                $groupe -> addUser($users[$nbUser]);


                $nbM = rand(1, 10);
                for($y = 1; $y < $nbM; $y++){
                   $message = new Message;

                   $message -> setDate(new \DateTime('now'));
                   $message -> setContent('lorem ipsum...');
                    $message -> setUser($users[$nbUser]);
                    $message -> setGroupe($groupe);
                    $message -> setState(rand(0, 3));
                    $manager -> persist($message);
                }
            }
        }
        $manager->flush();
    }
}
