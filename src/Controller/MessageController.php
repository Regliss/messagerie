<?php



namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Groupe;

use App\Entity\User;

use App\Entity\Groupe;



class MessageController extends AbstractController

{

    /**
<<<<<<< HEAD

     * @Route("/message/{id}", name="message

     */

    public function message($id)

    {

        $repoG = $this -> getDoctrine() -> getRepository(Groupe::class);



        $groupe = $repoG -> find($id);

        return $this->render('message/message.html.twig', [

           "users" => $groupe -> getUsers(),

           "groupe" => $groupe,

           "messages" => $groupe -> getMessages()

            

=======
     * @Route("/message/{id}", name="message")
     */
    public function message($id)
    {
        $repoG = $this -> getDoctrine() -> getRepository(Groupe::class);

        $groupe = $repoG -> find($id);
        return $this->render('message/message.html.twig', [
           "users" => $groupe -> getUsers(),
           "groupe" => $groupe,
           "messages" => $groupe -> getMessages()
            
>>>>>>> f9eeba86ea48247d1f40a292b7a22966286878a7
        ]);

    }

}