<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Locator\LocatorAwareTrait;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class UsersController extends AppController {

    public function initialize(): void
    {

        parent::initialize();

        $this->Auth->allow(['login', 'confirm', 'remember', 'resetPassword', 'signup', 'logout', 'administrateur']);
        $user = $this->Auth->user();
        debug($user);die;
        if($user != null){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $usersTable->find()->contain(['Entreprises', 'Candidats'])->where(['id_user' => $user['id_user']])->first();
            $this->set('user', $user);
        }
    }


	public function index(){
        $categorieTable = TableRegistry::getTableLocator()->get('Categories');
        $categories = $categorieTable->find()->all();
        $this->set('categories', $categories);
        $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
        $annonces = $annonceTable->find()->all();
        $this->set('annonces', $annonces);
        $entrepriseTable = TableRegistry::getTableLocator()->get('Entreprises');
        $entreprises = $entrepriseTable->find()->all();
        $this->set('entreprises', $entreprises);
        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidats = $candidatTable->find()->all();
        $this->set('candidats', $candidats);
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $users = $usersTable->find()->where(['OR' => [['role' => 'Entreprise'], ['role' => 'Candidat']]])->all();
        $this->set('users', $users);
        $this->menu('accueil');

        $this->render('index');
	}

    public function list(){

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $users = $usersTable->find()->where(['OR' => [['role' => 'Entreprise'], ['role' => 'Candidat']]])->all();
        $this->set('users', $users);
        $this->menu('accueil');

        $this->render('list');
    }



	function login(){
        $this->menu('home');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if($user['role'] == 'Admin'){
                    $verifyTable = TableRegistry::getTableLocator()->get('Verify_user');
                    $code = AppController::str_random(8);
                    $verify = $verifyTable->newEmptyEntity();
                    $verify->code = $code;

                    if($verifyTable->save($verify)){

                        $mail = new Email();
                        $mail->setFrom('support@melcom.com')
                            ->setTo($user['email'])
                            ->setSubject('[Melcom] Vérification Administrateur')
                            ->setEmailFormat('html')
                            ->setViewVars(array(
                                'nom' => $user['nom'].' '.$user['prenom'],
                                'code' => $code
                            ))
                            ->viewBuilder()
                            ->setTemplate('code');
                        $mail->send();
                        $err = false;
                        if ($err == true) {
                            $this->Flash->error('Votre email ou mot de passe est incorrect.');
                            return $this->redirect(['action' => 'login']);
                        } else {
                            return $this->redirect(['action' => 'administrateur', $user['email']]);
                        }

                    }else{
                        $this->Flash->error('Votre email ou mot de passe est incorrect.');
                        return $this->redirect(['action' => 'login']);
                    }
                }
                $this->Auth->setUser($user);
                $this->Flash->success('Content de vous revoir '.$this->Auth->user('nom').' '.$this->Auth->user('prenom'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre email ou mot de passe est incorrect.');
        }

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->newEmptyEntity();
        $this->set('user', $user);

    }

    function administrateur($email = null){

        $this->menu('home');
        $user = $this->Auth->user();
        if($user != null) {
            $this->set('user', false);
            $this->Auth->logout();
        }

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $verifyTable = TableRegistry::getTableLocator()->get('Verify_user');

        if (isset($this->request->getData()['email'])) {
            $user = $usersTable->find()->where(['email' => $this->request->getData()['email']])->first();
            $code = $verifyTable->find()->where(['code' => $this->request->getData()['code']])->first();
            if ($user && $code) {
                $verifyTable->delete($code);
                $this->Auth->setUser($user);
                $this->Flash->success('Content de vous revoir '.$this->Auth->user('nom').' '.$this->Auth->user('prenom'));
                return $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->Flash->error('Votre code de connexion est incorrect.');
            }
        }

        $not_logged = 1;
        $user = $usersTable->find()->where(['email' => $email])->first();
        $this->set('usr', $user);
        $this->set('$not_logged', $not_logged);

    }


    function logout(){
        $date = date('Y-m-d H:m:s');
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $this->Auth->user();
        if(is_array($user)){
            $user = $usersTable->get($user['id_user']);
        }
        return $this->redirect(['action' => 'login']);
    }

    function signup(){
        $this->menu('home');
          $usersTable = TableRegistry::getTableLocator()->get('Users');
          $new_user = $usersTable->newEntity([]);
          if($this->request->is('post')){
            if(empty($this->request->getData()['password']) || $this->request->getData()['password'] != $this->request->getData()['password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
                return $this->render('signup', 'login');
            }
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $exist_email = $usersTable->find()
                ->where(
                    [
                        'email' => $this->request->getData()['email'],
                    ]
                )
                ->limit(1)
                ->all();
            if(!$exist_email->isEmpty()){
                $this->Flash->error('Cette email existe déjà.');
                return $this->render('signup', 'login');
            }
            $user = $usersTable->newEntity($this->request->getData());
            $filename = $this->request->getData()['picture']['name'];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $good_ext = in_array($extension, ['png', 'jpg', 'jpeg']);
            if($good_ext && $filename != ''){
                $user->picture = $this->request->getData()["picture"]["name"];
                move_uploaded_file($this->request->getData()["picture"]["tmp_name"],"img/user/".$this->request->getData()["picture"]["name"]);
            }else{
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                return $this->render('signup', 'login');
            }
           if ($usersTable->save($user)) {
                $link = array(
                    'controller' => 'users',
                    'action' => 'confirm',
                    'token' => $user->id.'-'.md5($user->Password)
                );
                $user->confirmed_token = md5($user->Password);
                $usersTable->save($user);
                $mail = new Email();
                $mail->setFrom('support@melcom.com')
                     ->setTo($user->email)
                     ->setSubject('Confirmation d\'enregistrement ')
                     ->setEmailFormat('html')
                        ->setViewVars(array(
                            'nom' => $user->nom.' '.$user->prenom,
                            'link' => $link
                        ))
                        ->viewBuilder()
                        ->setTemplate('confirmation');
                     $mail->send();
                $this->Flash->set('Vous avez été enregistrer avec succès, un email de confirmation vous a été envoyé.', ['element' => 'success']);
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'signup',
                ));
           }else{
                $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'danger']);
           }
        }
        $this->set('new_user', $new_user);
        $this->render('signup');

    }

    function edit($id = null){
        $this->menu('home');
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->get($id);
        if (!$user) {
            $this->Flash->error('Ce profil n\'exite pas');
            return $this->redirect(['action' => 'logout']);
        }
        if ($this->request->is(array('post','put'))) {
            if(empty($this->request->getData()['Password']) || $this->request->getData()['Password'] != $this->request->getData()['Password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
            }else{
                $user = $usersTable->newEntity($this->request->getData());
                if ($usersTable->save($user)) {
					          $this->Flash->set('Vos informations ont été mis à jour avec succès.', ['element' => 'success']);
                    return $this->redirect(['action' => 'index']);
                }else{
                    $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'error']);
                }
            }
        }
        $this->set('user_edit', $user);
        $this->render('edit');
    }

    function confirm(){
        $token = $_GET['token'];
        $token = explode('-', $token);
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->find()
                            ->where(
                                [
                                    'id' => $token[0],
                                    'confirmed_token' => $token[1],
                                ]
                            )
                            ->limit(1)
                            ->all();
        if(!empty($user->first())){
            $user = $user->first();
            $user->confirmed_at = date('Y-m-d H:m:s');
            $user->confirmed_token = NULL;
            $usersTable->save($user);
            $this->Flash->set('Bienvenue '.$user->nom.' '.$user->prenom, ['element' => 'success']);
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }else{
            $this->Flash->set('Ce lien n\'est plus valide.', ['element' => 'error']);
            return $this->redirect(array(
                'controller' => 'users',
                'action' => 'login',
            ));
        }
    }

    function remember(){
        $this->menu('home');
        if($this->request->is('post')){
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $data = $this->request->getData();
            $user = $usersTable->find()
                ->where([
                    'email' => $data['email'],
                ])
                ->limit(1)
                ->all();
            if(empty($user->first())){
                $this->Flash->error('Aucun Profil ne correspond à cette email.');
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'reset_password',
                ));
            }else{
                $user = $user->first();
				/*$link = array(
                    'controller' => 'users',
                    'action' => 'reset_password',
                    'token' => $user->id.'-'.md5($user->password)
                );*/
				$link = "http://localhost/melcom/users/reset_password/?token=".$user->id.'-'.md5($user->password);
				$user->reset_token = md5($user->password);
                $usersTable->save($user);
                $mail = new Email();
                $mail->setFrom('support@melcom.com')
                    ->setTo($user->email)
                    ->setSubject('Mot de Passe Oublié')
                    ->setEmailFormat('html')
                    ->setViewVars(array(
                        'last_name' => $user->nom.' '.$user->prenom,
                        'link' => $link
                    ))
                    ->viewBuilder()
                    ->setTemplate('forget_password');
                    $mail->send();
                $this->Flash->success('Un email a été envoyer à votre boîte mail pour réinitialiser votre mot de passe.');
                $this->_log('Envoi de mail de réinitialisation à utilisateur '.$user->id);
            }
        }
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->newEmptyEntity();
        $this->set('user', $user);
        $this->render('remember');
    }

    function resetPassword(){
        $this->menu('home');
        $usersTable = TableRegistry::getTableLocator()->get('Users');

        if(!empty($_GET['token'])){
            $token = $_GET['token'];
            $token = explode('-', $token);
            $user = $usersTable->find()
                ->where([
                    'id' => $token[0],
                    'reset_token' =>$token[1],
                ])
                ->limit(1)
                ->all();
            if(empty($user->first())){
                $this->Flash->error('Ce lien n\'est pas valide.');
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                ));
            }else{
                $user = $user->first();
                $this->set('user', $user);
            }
        }

        if($this->request->is('post')){
            if(empty($this->request->getData()['password']) || $this->request->getData()['password'] != $this->request->getData()['password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
                return $this->render('reset_password', 'login');
            }
            $user = $usersTable->find()
                ->where([
                    'email' => $this->request->getData()['email'],
                ])
                ->limit(1)
                ->all();
            $user = $user->first();
            if (!$user) {
                $this->Flash->error('Cette utilisateur n\'est pas valide.');
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                ));
            }
            $user->reset_at = date('Y-m-d H:m:s');
            $user->reset_token = NULL;
            $user->password = $this->request->getData()['password'];
            $usersTable->save($user);
            $this->Auth->setUser($user);
            $this->Flash->success('Mot de passe réinitialisé avec succès.');
            $this->_log('Mot de passe réinitialisé pour utilisateur '.$user->id_user);
            return $this->redirect([
                'controller' => 'Melcom',
                'action' => 'index',
            ]);

        }

        $usr = $this->Auth->user();
        $this->set('usr', $usr);

        $this->render('reset_password');
    }

    public function delete(){
        if(empty($this->request->params['?']['user'])){
            $this->Flash->error('Information manquante.');
            return $this->redirect(['action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['user'];
        }
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->get($id);
        if (!$user) {
            $this->Flash->error('Ce profil n\'exite pas');
            return $this->redirect(['action' => 'logout']);
        }else{
            $usersTable->delete($user);
            $this->Flash->set('Le membre a été supprimé avec succès.', ['element' => 'success']);
            $this->redirect(['controller' => 'Users','action' => 'index']);
        }
    }

}
