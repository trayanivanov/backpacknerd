<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('calendar.html.twig');
    }
}
