<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    /**
	*@Route("/", name="index")
	*
	*/
	public function login(AuthenticationUtils $auth){
		//Le username de la personne qui se connect
		$lastUsername = $auth -> getLastUsername();
		//erreur d'identification
		$error = $auth -> getLastAuthenticationerror();
		if($error){
			$this -> addFlash('errors', 'Problème d\'identifiant');
		}


		return $this -> render('user/login.html.twig', array(
			'lastUsername' => $lastUsername,)
		);

	}

	/**
	*@Route("/register", name="register")
	*
	*/
	public function register(Request $request, UserPasswordEncoderInterface $encoder){

		$manager = $this -> getDoctrine() -> getManager();
		$user = new User;//objet vide
		$form = $this -> createForm(UserType::class, $user);

		$form -> handleRequest($request);

		if($form -> isSubmitted() && $form -> isValid()){
			$manager -> persist($user);

			//Encodage du password
			$password = $user -> getPassword();
			$user -> setPassword($encoder -> encodePassword($user, $password));

			$manager -> flush();
			$this -> addFlash('success', 'Votre inscription a été prise en compte');
			return $this -> redirectToRoute('index');
		}

		return $this -> render('user/register.html.twig', array(
			'userForm' => $form -> createView()
		));
	}

	/**
	*Route nécessaire pour le fonctionnement de la sécurité de ma connexion de SF
	* @Route("/login_check", name="login_check")
	*/
	public function loginCheck(){

	}

	/**
	*@Route("/logout", name="logout")
	*
	*/
	public function logout(){
		return $this -> redirectToRoute('index');

	}
}
