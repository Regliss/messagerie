<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Groupe;
use App\Form\GroupeType;

class GroupeController extends AbstractController
{
    /**
    * @Route("/groupeAdd", name="groupeAdd")
    *
    */
public function creationGroupe(Request $request){

    $manager = $this -> getDoctrine() -> getManager();
    $groupe = new Groupe; 

    $form = $this -> createForm(GroupeType::class, $groupe);
    $form -> handleRequest($request);

    if($form -> isSubmitted() && $form -> isValid()){
        $manager -> persist($groupe);
        
        $groupe -> setDate(new \DateTime('now'));
        $groupe -> setUserAdmin($this -> getUser());

        //$groupe -> getUsers() --> array Collection
        foreach($groupe -> getUsers() as $user){
            //$groupe -> addUser($user);
            $user -> addGroupe($groupe);
        }
        $manager -> flush($groupe);
    }
        return $this -> render('groupe/groupeAdd.html.twig', array(
            'groupeForm' => $form -> createView()
        ));

}

}
