<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'contact_form_name'])
            ->add('email', EmailType::class, ['label' => 'contact_form_email'])
            ->add('message', TextareaType::class, ['label' => 'contact_form_message', 'attr' => ['rows' => 5]])
            ->add('send', SubmitType::class, ['label' => 'contact_form_send'])
        ;
    }
}
