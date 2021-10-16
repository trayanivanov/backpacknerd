<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank(message="Задължително поле")
     */
    protected string $name;

    /**
     * @Assert\NotBlank(message="Задължително поле")
     * @Assert\Email(message="Невалидна е-поща")
     */
    protected string $email;

    /**
     * @Assert\NotBlank(message="Задължително поле")
     */
    protected string $message;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
