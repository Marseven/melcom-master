<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Utility\Hash;

class UsersTable extends Table
{

    public function initialize(array $config) : void
    {
        $this->setTable('users');

        $this->hasMany('Categories')
             ->setForeignKey('id_user')
             ->setDependent(true);

        $this->hasMany('Annonces')
            ->setForeignKey('id_user')
            ->setDependent(true);

        $this->hasMany('Entreprises')
            ->setForeignKey('id_user')
            ->setDependent(true);

        $this->hasMany('Candidats')
            ->setForeignKey('id_user')
            ->setDependent(true);
    }

    public function validationDefault(Validator $validator) : Validator
    {
        $validator
            ->requirePresence('nom')
            ->notEmptyString('nom', 'Ce champ doit être rempli.')
            ->requirePresence('email')
            ->add('email', [
                'length' => [
                    'rule' => 'email',
                    'message' => 'Ex : abc@xyz.cfr',
                ]
            ])
            ->requirePresence('telephone')
            ->notEmptyString('telephone', 'Ce champ doit être rempli.')
            ->requirePresence('password')
            ->notEmptyString('password', 'Ce champ doit être rempli.')
            ->requirePresence('password_verify')
            ->notEmptyString('password_verify', 'Ce champ doit être rempli.');

        return $validator;
    }

}
