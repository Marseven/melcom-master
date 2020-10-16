<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use App\Form\ContactForm;

class SearchController extends AppController
{
    public function initialize() : void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->Auth->allow(['index', 'annonceByCategory', 'candidatByAnnonce', 'annonceByEntreprise']);
        $user = $this->Auth->user();
        if($user != null){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $usersTable->find()->contain(['Entreprises', 'Candidats'])->where(['id' => $user['id']])->first();
            $this->set('user', $user);
        }
    }

    public function index()
    {

        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $annonces = $this->Paginator->paginate($annonceTable->find('Search', ['search' => $this->request->getQuery()['q']])->contain(['Categories', 'Entreprises']));

        $entrepriseTable = TableRegistry::getTableLocator()->get('entreprises');
        $entreprises = $this->Paginator->paginate($entrepriseTable->find('Search', ['search' => $this->request->getQuery()['q']])->contain(['Annonces']));

        $candidatTable = TableRegistry::getTableLocator()->get('candidats');
        $candidats = $this->Paginator->paginate($candidatTable->find('Search', ['search' => $this->request->getQuery()['q']])->contain(['Annonces']));


        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->set(compact('entreprises'));
        $this->set('_serialize', ['entreprises']);

        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);

        $this->menu('annonces');
        $this->render('index');
    }

    public function annonceByCategory($category)
    {
        $categorieTable = TableRegistry::getTableLocator()->get('categories');
        $query = $categorieTable->find()->contain(['Annonces'])->where(['id' => $category])->all();
        $query = $query->first()->annonces;
        $annonces = $query;
        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);
        $this->menu('annonces');
    }

    public function candidatByAnnonce($annonce)
    {
        $candidatTable = TableRegistry::getTableLocator()->get('annonces');
        $query = $candidatTable->find()->contain(['Annonces'])->where(['id_annonce' => $annonce]);
        $candidats = $this->Paginator->paginate($query);
        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);
        $this->menu('annonces');
    }

    public function annonceByEntreprise($entreprise)
    {
        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $query = $annonceTable->find()->contain(['Categories', 'Entreprises'])->where(['annonces.id_entreprise' => $entreprise]);
        $annonces = $this->Paginator->paginate($query);
        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);
        $this->menu('annonces');
    }
}
