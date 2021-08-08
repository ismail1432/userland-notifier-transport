<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class SandboxController extends AbstractController
{
    /**
     * @Route("/sandbox", name="sandbox")
     */
    public function index(NotifierInterface $notifier): Response
    {
        $notification = new Notification('Welcome abroad <3', ['chat/userland']);
        $notifier->send($notification);

        return $this->render('sandbox/index.html.twig', [
            'controller_name' => 'SandboxController',
        ]);
    }
}
