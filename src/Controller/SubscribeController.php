<?php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscribeController extends AbstractController
{
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return $this->render('pages/subscribe.html.twig');
    }

    public function registration()
    {
        $test = True; 
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email =$_POST['email'];
        $emailConfirmation =$_POST['email_confirmation'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        $availableEmail= $this->userRepo->availableEmail($email);
        if($availableEmail===False)
        {
            $test=False;
        }
        $availableEmail = $this->testEmail($email, $emailConfirmation);
        if(!$availableEmail)
        {
            $test=False;
        }
        $identicalPassworld = $this->testPassword($password, $passwordConfirmation);
        if(!$identicalPassworld)
        {
            $test=False;
        }
        if(!$test)
        {
            return $this->render('pages/subscribe.html.twig');
        }
        else
        {
            if($lastname==='' And $firstname==='')
            {
                return $this->render('pages/subscribe.html.twig');
            }
            else
            {
                $this->addUserInDB($firstname, $lastname, $email, $password);
                return $this->render('pages/connection.html.twig'); 
            }
        }
    }

    private function testEmail($email, $emailConfirmation)
    {
        if($email===$emailConfirmation)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    private function testPassword($password, $passwordConfirmation)
    {
        if($password===$passwordConfirmation)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    private function addUserInDB($firstname, $lastname, $email, $password)
    {
        $user = new User();
        $user->setFirstname($firstname)
            ->setName($lastname)
            ->setEmail($email)
            ->setPassword($password);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
    }
}