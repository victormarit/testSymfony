<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;


class ConnectionController extends AbstractController
{

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return $this->render('pages/connection.html.twig');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->userRepo->findUserOnDB($email, $password);
        if(sizeof($user)>0)
        {
            return $this->render('pages/homepage.html.twig',[
                'isLog'=>'auth'
            ]);
        }
        else
        {
            return $this->render('pages/connection.html.twig',[
                'isLog'=>'fail'
            ]);
        }; 
    }

}