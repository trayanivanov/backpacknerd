<?php

namespace App\Controller;

use App\Form\Contact;
use App\Form\Type\ContactType;
use App\Services\EmailBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class ContactsController extends AbstractController
{
    public function index(Request $request, EmailBuilder $emailBuilder, MailerInterface $mailer): Response
    {
        $contactForm = $this->createForm(ContactType::class, new Contact());

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            /** @var Contact $data */
            $data = $contactForm->getData();

            try {
                $emailToAdmin = $emailBuilder->adminContactForm($data);
                $mailer->send($emailToAdmin);
                $emailToVisitor = $emailBuilder->visitorContactForm($data);
                $mailer->send($emailToVisitor);
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', 'Съобщението не е изпратено. Моля опитайте пак.');
                return $this->redirectToRoute('contacts');
            }

            $this->addFlash('success', 'Съобщението е изпратено успешно!');
            return $this->redirectToRoute('contacts');
        }

        return $this->render('contacts.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
