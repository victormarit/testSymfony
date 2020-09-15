<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscribeController extends AbstractController
{
    public function index()
    {
        return $this->render('pages/subscribe.html.twig');
    }
}