<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\FrozenTime;



class EntreprisesController extends AppController
{

    public function initialize(): void
    {

        parent::initialize();

        $this->loadComponent('Paginator');

        $this->Auth->allow(['index']);
        $user = $this->Auth->user();

        if($user != null){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $usersTable->find()->contain(['Entreprises', 'Candidats'])->where(['id' => $user['id']])->first();
            $this->set('user', $user);
        }
    }

    public function index(){
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprises =  $this->Paginator->paginate($entrepriseTable->find()->contain('Annonces'));

        $this->menu('annonces');

        $this->set(compact('entreprises'));
        $this->set('_serialize', ['entreprises']);

        $this->render('index');
    }

    public function add(){
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprise = $entrepriseTable->newEntity([]);

        $usersTable = TableRegistry::getTableLocator()->get('users');
        $user = $usersTable->newEntity([]);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $file = $data['image'];
            $filename = $file->getClientFilename();
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $good_ext = in_array($extension, ['png', 'jpg', 'jpeg']);
            if($good_ext && $filename != ''){
                $data['image'] = $filename;
                $file->moveTo("img/entreprise/".$filename);
                $entreprise = $this->Entreprises->patchEntity($entreprise, $data);

                //création du profil de connexion de l'entreprise
                $mdp = AppController::str_random(6);
                $user->nom = $entreprise->referent;
                $user->email = $entreprise->email;
                $exist_email = $usersTable->find()
                    ->where(
                        [
                            'email' => $user->email,
                        ]
                    )
                    ->limit(1)
                    ->all();
                if(!$exist_email->isEmpty()){
                    $this->Flash->error('Cette email existe déjà pour un référent.');
                    return $this->render('add');
                }
                $user->password = $mdp;
                $user->password_verify = $mdp;
                $user->telephone = $entreprise->telephone;
                $user->picture = $entreprise->image;
                $user->role = 'Entreprise';

                if ($usersTable->save($user)) {
                    if ($this->Entreprises->save($entreprise)) {

                        $mail = new Email();
                        $mail->setFrom('support@melcom.com')
                            ->setTo($user->email)
                            ->setSubject('[Mel Com] Bienvenu sur Mel Com !')
                            ->setEmailFormat('html')
                            ->setViewVars(array(
                                'nom' => $user->nom,
                                'mdp' => $mdp,
                            ))
                            ->viewBuilder()
                            ->setTemplate('new_entreprise');
                        $mail->send();

                        $this->Flash->success(__('L\'entreprise a été enregistré. Le mail de confirmation a été envoyé référent.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('L\'entreprise n\'a pas été enregistré. S\'il vous plaît essayez plus tard.'));
                    }
                } else {
                    $this->Flash->error(__('L\'entreprise n\'a pas été enregistré et les identifiants de connexion générés. S\'il vous plaît essayez plus tard.'));
                }


            }else{
                $this->set(compact('entreprise'));
                $this->set('_serialize', ['entreprise']);
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                $this->redirect(['action' => 'add']);
            }
        }

        $this->set(compact('entreprise'));
        $this->set('_serialize', ['entreprise']);

        $this->menu('annonces');
        $this->render('add');
    }

    public function edit($id = null){
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprise = $entrepriseTable->get($id);

        $usersTable = TableRegistry::getTableLocator()->get('users');
        $user = $usersTable->find()->where(['email' => $entreprise->email])->all();
        $user =  $user->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $file = $data['image'];
            $filename = $file->getClientFilename();
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $good_ext = in_array($extension, ['png', 'jpg', 'jpeg']);
            if($good_ext && $filename != ''){
                $data['image'] = $filename;
                $file->moveTo("img/entreprise/".$filename);
                $entreprise = $this->Entreprises->patchEntity($entreprise, $data);

                $entreprise = $this->Entreprises->patchEntity($entreprise, $data);

                //modification du profil de connexion de l'entreprise
                $mdp = AppController::str_random(6);
                $user->nom = $entreprise->referent;
                $user->email = $entreprise->email;
                $exist_email = $usersTable->find()
                    ->where(
                        [
                            'email' => $user->email,
                        ]
                    )
                    ->limit(1)
                    ->all();
                if(!$exist_email->isEmpty()){
                    $this->Flash->error('Cette email existe déjà pour un référent.');
                    return $this->render('add');
                }
                $user->telephone = $entreprise->telephone;
                $user->picture = $entreprise->image;

                if ($usersTable->save($user)) {
                    $entreprise->id = $user->id;
                    if ($entrepriseTable->save($entreprise)) {
                        $this->Flash->success(__('La entreprise a été modifié.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('L\'entreprise n\'a pas été modifié. S\'il vous plaît essayez plus tard.'));
                    }
                } else {
                    $this->Flash->error(__('L\'entreprise n\'a pas été modifié. S\'il vous plaît essayez plus tard.'));
                }

            }else{
                $this->set(compact('entreprise'));
                $this->set('_serialize', ['entreprise']);
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                $this->redirect(['action' => 'edit', $entreprise->id_entreprise]);
            }
        }

        $this->set(compact('entreprise'));
        $this->set('_serialize', ['entreprise']);

        $this->menu('annonces');
        $this->render('edit');
    }

    public function list(){
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');

        $entreprises = $this->paginate($entrepriseTable);

        $this->set(compact('entreprises'));
        $this->set('_serialize', ['entreprises']);

        $this->menu('annonces');
    }

    public function annonceByEntreprise($entreprise)
    {
        $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
        $query = $annonceTable->find()->contain(['Categories', 'Entreprises'])->where(['id_entreprise' => $entreprise]);
        $annonces = $this->Paginator->paginate($query);

        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprise = $entrepriseTable->get($entreprise);
        $this->set(compact('entreprise'));
        $this->set('_serialize', ['entreprise']);

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);
        $this->menu('annonces');
    }

    public function candidatByAnnonce($entreprise)
    {
        $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
        $query = $annonceTable->find()->contain(['Candidats'])->where(['id_entreprise' => $entreprise]);
        $candidats = $this->Paginator->paginate($query);
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprise = $entrepriseTable->get($entreprise);
        $this->set(compact('entreprise'));
        $this->set('_serialize', ['entreprise']);
        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);
        $this->menu('annonces');
    }


    public function delete($id = null)
    {
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprise = $entrepriseTable->get($id);

        $usersTable = TableRegistry::getTableLocator()->get('users');
        $user = $usersTable->find()->where(['email' => $entreprise->email])->all();
        $user =  $user->first();
        $usersTable->delete($user);

        if ($entrepriseTable->delete($entreprise)) {
            $this->Flash->success(__('L\'entreprise a été supprimée.'));
        } else {
            $this->Flash->error(__('L\'entreprise ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
