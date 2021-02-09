<?php

namespace App\Controller;

use App\Entity\Mail;
use App\Form\MailType;
use App\Repository\MailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mail")
 */
class MailController extends AbstractController
{
    /**
     * @Route("/send", name="mail_send", methods={"GET"})
     */
    public function index(\Swift_Mailer $mailer,Request $request) : Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        
        $name = $session->get('name');
       $message = (new \Swift_Message('Bonjour'))
        ->setFrom('malekalkhatib4@gmail.com')
        ->setTo('malekalkhatib4@gmail.com')
        ->setBody('Bonjour');
    $mailer->send($message);
    $this->addFlash('notice', 'Email sent');

    return $this->redirectToRoute('home');
        }
    }
   


    /**
     * @Route("/home", name="home", methods={"GET"})
     */
    public function home(Request $request) : Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $session=$request->getSession();
        $name = $session->get('name');
        return $this->render('mail/home.html.twig', ['name' => $name]);
        }
           
    }

    /**
     * @Route("/send", name="mail_send", methods={"GET"})
     */
    
    /*public function index( \Swift_Mailer $mailer)
    {
        
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'mail/registration.html.twig',
                    
                ),
                'text/html'
            )
    
           
        ;
    
        $mailer->send($message);
    
        return $this->render('mail/home.html.twig');
    }*/
    



   
   
}