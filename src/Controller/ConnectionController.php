<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnectionController extends AbstractController
{
    public function index()
    {
        return $this->render('pages/connection.html.twig');
    }
}