<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

class ContactForm extends Form
{

    protected function buildSchema(Schema $schema) : Schema
    {
        return $schema->addField('name', 'string')
            ->addField('email', ['type' => 'string'])
            ->addField('phone', ['type' => 'string'])
            ->addField('body', ['type' => 'text']);
    }

    protected function buildValidator(Validator $validator) : Validator
    {
        return $validator->add('name', 'length', [
            'rule' => ['minLength', 2],
            'message' => 'Un nom est requis'
        ])->add('email', 'format', [
            'rule' => 'email',
            'message' => 'Une adresse email valide est requise',
        ])->add('subject', 'format', [
            'rule' => ['minLength', 2],
            'message' => 'Un sujet est requis',
        ])->add('body', 'format', [
            'rule' => ['minLength', 2],
            'message' => 'Un contenu est requis',
        ]);
    }

    public function setErrors(array $errors)
    {
        $this->_errors = $errors;
    }

    protected function _execute(array $data) : bool
    {
        // Envoie un email.
        $mail = new Email();
        $mail->setFrom($data['email'])
            ->setTo('mebodoaristide@gmail.com')
            ->setSubject('Contact | Melcom')
            ->setEmailFormat('html')
            ->setTemplate('contact')
            ->setViewVars([
                'auteur' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'message' => $data['body'],
            ])
            ->send();
        return true;
    }
}
