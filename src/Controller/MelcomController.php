<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;

class MelcomController extends AppController
{

    public function initialize(): void
    {

        parent::initialize();

        $this->loadComponent('Paginator');

        $this->Auth->allow(['index', 'apropos', 'contact', 'search']);
        $user = $this->Auth->user();
        if($user != null){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $usersTable = TableRegistry::getTableLocator()->get('users');
            $user = $usersTable->find()->contain(['entreprises', 'candidats'])->where(['id' => $user['id']])->first();
            $this->set('user', $user);
        }
    }

    public function index(){

        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $annonces = $this->Paginator->paginate($annonceTable->find()->contain(['categories', 'entreprises']));
        $categorieTable = TableRegistry::getTableLocator()->get('categories');
        $categories = $categorieTable->find()->contain(['annonces'])->all();

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);

        $this->menu('home');
    }

    public function apropos(){
        $this->menu('about');
    }

    public function contact(){

        $this->menu('contacter');
        $contact = new ContactForm();
        $this->set('contact', $contact);

    }

    public function search()
    {

        $annonceTable = TableRegistry::getTableLocator()->get('annonces');

        $annonces = $this->Paginator->paginate($annonceTable->find()->contain(['Categories', 'Entreprises'])->where(['ville' => $this->request->getQuery()['ville']]));

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $categorieTable = TableRegistry::getTableLocator()->get('categories');
        $categories = $categorieTable->find()->contain(['Annonces'])->all();
        $this->set(compact('categories'));

        $this->menu('home');
        $this->render('search');
    }
}
