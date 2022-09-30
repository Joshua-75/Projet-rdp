<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class HomeController extends AbstractController
{
    /*
    * @Route(["/home","/"], name="app_home")
    */
    #[Route(['/home', '/'], name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
    * @Route("/contact", name="app_contact")
    */
    public function contact(Request $request, MailerInterface $mailer): Response
    { 
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        
        //var_dump($form); die();
        
        //Si formulaire soumis
        if ($form->isSubmitted() && $form->isValid()) {
             
            //Récupération des données
            $data = $form->getData();
            $client = "Client : Non";
            //var_dump($data["email"]);die();
            
            $user = $this->getUser();
            if($user){
                $data["email"] = $user->getEmail();
                $client = "Client : " . $user->getUsernames();
            } 
            //Contenu à envoyer
            
            $email = (new TemplatedEmail())
                        ->from(new Address($data["email"], 'Projet-rdp'))
                        ->to("Josh.naine@hotmail.fr")//test
                        //->cc('cc@example.com')
                        //->bcc('bcc@example.com')
                        //->replyTo('fabien@example.com')
                        //->priority(Email::PRIORITY_HIGH)
                        ->subject($data["objet"])
                        //->text($user->getToken())
                        ->htmlTemplate('contact/template_mail_nous_contacter.html.twig')
                        ->context([
                            'client' => $client,
                            'telephone' => $data["telephone"],
                            'message' => $data["message"],
                            ]);
                        $mailer->send($email);
            //  

            $this->addFlash('success', 'Votre demande a bien été envoyé.');
             
            //var_dump($data["email"]);die();
            
            //  Vider après envoi du formulaire 

            unset($form);
            $form = $this->createForm(ContactType::class);

            return $this->render('contact/index.html.twig', [
                
                'form' => $form->createView(),
            ]);  }
            //die('okey');
            return $this->render('contact/index.html.twig', [
                'form' => $form->createView(),
            ]);    
        }
}
