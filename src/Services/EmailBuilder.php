<?php

namespace App\Services;

use App\Form\Contact;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class EmailBuilder
{
    public const ADMIN_EMAIL = 'trayan@backpacknerd.com';
    public const ADMIN_NAME = 'Backpack Nerd';

    public function adminContactForm(Contact $contact): Email
    {
        $name = $contact->getName();
        $email = $contact->getEmail();
        $message = nl2br($contact->getMessage());

        return (new Email())
            ->from(Address::create(sprintf('%s <%s>', self::ADMIN_NAME, self::ADMIN_EMAIL)))
            ->to(self::ADMIN_EMAIL)
            ->replyTo($email)
            ->subject('Контактна форма - Backpack Nerd')
            ->text(sprintf('Ново съобщение от %s (%s) - %s', $name, $email, $message))
            ->html("
                <h3>Хей Backpack Nerd! Имаш ново съобщение:</h3>
                <p>
                    <strong>От:</strong> $name<br>
                    <strong>Е-поща:</strong> $email<br><br>
                    <strong>Съобщение:</strong><br> $message<br>
                </p>
            ");
    }

    public function visitorContactForm(Contact $contact): Email
    {
        $name = $contact->getName();
        $email = $contact->getEmail();

        return (new Email())
            ->from(Address::create(sprintf('%s <%s>', self::ADMIN_NAME, self::ADMIN_EMAIL)))
            ->to($email)
            ->replyTo(self::ADMIN_EMAIL)
            ->subject('Контактна форма - Backpack Nerd')
            ->text('Твоето съобщение е получено успешно! Скоро ще отговоря!')
            ->html("
                <h3>Привет $name (:</h3>
                <p>
                    Твоето съобщение е получено успешно!<br>
                    Очаквай отговор съвсем скоро.
                </p>
                <p>
                    Поздрави,<br>
                    Backpack Nerd - Траян
                </p>
            ");
    }
}
