<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\Mailer\Email;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use SimpleXMLElement;

class CandidatsController extends AppController
{

    public function initialize(): void
    {

        parent::initialize();

        $this->loadComponent('Paginator');

        $this->Auth->allow(['index', 'add', 'view', 'payer', 'callback']);
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
        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidats = $this->Paginator->paginate($candidatTable->find());

        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);

        $categorieTable = TableRegistry::getTableLocator()->get('Categories');
        $categories = $categorieTable->find()->contain(['Annonces'])->all();

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);

        $this->menu('postuler');
    }

    public function list(){
        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidats = $this->Paginator->paginate($candidatTable->find());

        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);

        $this->menu('postuler');
    }

    public function annonceByCandidat($candidat)
    {
        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $query = $candidatTable->find()->contain(['Annonces'])->where(['id' => $candidat]);
        $candidats = $this->Paginator->paginate($query);
        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);
        $this->menu('annonces');
    }


    public function add(){
        $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
        $annonces = $annonceTable->find()->all();
        $annonces = $this->tableAnc($annonces);

        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidat = $candidatTable->newEntity([]);

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->newEntity([]);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $file = $data['image'];
            $filename = $file->getClientFilename();
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $good_ext = in_array($extension, ['png', 'jpg', 'jpeg']);
            if($good_ext && $filename != ''){
                $data['image'] = $filename;
                $file->moveTo("img/candidat/".$filename);
                $data['formations'] = $data['formations'][0].';'.$data['formations'][1].';'.$data['formations'][2];
                $data['experiences'] = $data['experiences'][0].';'.$data['experiences'][1].';'.$data['experiences'][2];
                $data['organisations'] = $data['organisations'][0].';'.$data['organisations'][1].';'.$data['organisations'][2];
                $candidat = $candidatTable->patchEntity($candidat, $data);

                //création du profil de connexion du candidat
                $mdp = AppController::str_random(8);
                $user->nom = $candidat->nom;
                $user->email = $candidat->email;
                $exist_email = $usersTable->find()
                    ->where(
                        [
                            'email' => $candidat->email,
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
                $user->telephone = $candidat->telephone;
                $user->picture = $candidat->image;
                $user->role = 'Candidat';

                if ($usersTable->save($user)) {
                    $candidat->id_user = $user->id;
                    if ($candidatTable->save($candidat)) {
                        $annonce_candidat = $annonce_candidatTable->newEntity([]);
                        $annonce_candidat->candidat_id = $candidat->id;
                        $annonce_candidat->annonce_id =$this->request->getData()["id_annonce"];
                        $annonce_candidatTable->save($annonce_candidat);

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
                            ->setTemplate('new_user');
                        $mail->send();

                        $this->Flash->success(__('Votre candidature a été enregistré. Veuillez compléter la procédure en effectuant le paiment des frais de dossier.'));
                        return $this->redirect(['action' => 'payer', $candidat->id]);
                    } else {
                        $this->Flash->error(__('Votre candidat n\'a pas été enregistré. S\'il vous plaît essayez plus tard.'));
                    }
                } else {
                    $this->Flash->error(__('Votre candidat n\'a pas été enregistré et les identifiants de connexion générés. S\'il vous plaît essayez plus tard.'));
                }

            }else{
                $this->set(compact('candidat'));
                $this->set('_serialize', ['candidat']);
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                $this->redirect(['action' => 'add']);
            }
        }

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->set('candidat', $candidat);
        $this->set('_serialize', ['candidat']);

        $this->menu('postuler');
    }

    public function edit($id=null){
        $annonce_candidatTable = TableRegistry::getTableLocator()->get('Annonces_candidats');

        $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
        $annonces = $annonceTable->find()->all();
        $annonces = $this->tableAnc($annonces);

        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidat = $candidatTable->get($id);

        $usersTable = TableRegistry::getTableLocator()->get('users');
        $user = $usersTable->find()->where(['email' => $candidat->email])->all();
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
                $candidat = $candidatTable->patchEntity($candidat, $data);

                //création du profil de connexion du candidat
                $user->nom = $candidat->nom;
                $user->email = $candidat->email;
                $user->telephone = $candidat->telephone;
                $user->picture = $candidat->image;

                $usersTable->save($user);

                if ($usersTable->save($user)) {
                    if ($candidatTable->save($candidat)) {
                        $annonce_candidat = $annonce_candidatTable->newEntity([]);
                        $annonce_candidat->candidat_id = $candidat->id;
                        $annonce_candidat->annonce_id =$this->request->getData()["id_annonce"];
                        $annonce_candidatTable->save($annonce_candidat);

                        $this->Flash->success(__('Lae candidat a été modifié.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Le candidat n\'a pas été modifié. S\'il vous plaît essayez plus tard.'));
                    }
                } else {
                    $this->Flash->error(__('Votre candidat n\'a pas été modifiée. S\'il vous plaît essayez plus tard.'));
                }


            }else{
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                $this->redirect(['action' => 'edit', $candidat->id]);
            }
        }

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);

        $this->menu('postuler');
    }

    public function payer($candidat){

        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidat = $candidatTable->find()->contain('Annonces')->where(['id' => $candidat, 'payer is' => NULL])->all();

        $candidat = $candidat->first();

        if($candidat){
            $reference = AppController::str_random(10);
            $reference = 'Ref'.$reference;

            $this->set(compact('candidat'));
            $this->set('_serialize', ['candidat']);
            $this->set(compact('reference'));
            $this->set('_serialize', ['reference']);
        }else{
            $this->Flash->success('Cette candidature est déjà en cours de traitement.');
            $this->redirect(['controller' => 'Melcom','action' => 'index']);
        }

        $this->menu('postuler');
    }

    public function callback($candidat){
        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $candidat = $candidatTable->get($candidat);

        $data_received = file_get_contents("php://input");
        $data_received_xml = new SimpleXMLElement($data_received);
        $ligne_response = $data_received_xml[0];
        $interface_received = $ligne_response->INTERFACEID;
        $reference_received = $ligne_response->REF;
        $type_received = $ligne_response->TYPE;
        $statut_received = $ligne_response->STATUT;
        $operateur_received = $ligne_response->OPERATEUR;
        $client_received = $ligne_response->TEL_CLIENT;
        $message_received = $ligne_response->MESSAGE;
        $token_received = $ligne_response->TOKEN;
        $agent_received = $ligne_response->AGENT;

        $connection = ConnectionManager::get('default');
        $results = $connection
        ->execute(
            'INSERT INTO paiement (interfaceid, ref, type, statut, operateur, tel_client, message, token, agent)
                VALUES ("'.$interface_received.'","'.$reference_received.'","'.$type_received.'","'.$statut_received.'","'.$operateur_received.'","'.$client_received.'","'.$message_received.'","'.$token_received.'","'.$agent_received.'")
            '
        );


        if($statut_received == 200){
                //envoi d'un email pour informer le client de son code secret
            $mail = new Email();
            $mail->setFrom('contact@melcom.com')
                ->setTo($candidat->email)
                ->setSubject('Candidature - Melcom ')
                ->setEmailFormat('html')
                ->setTemplate('information')
                ->setViewVars(array(
                    'last_name' => $candidat->nom,
                ))
                ->send();

            $candidat->payer = 1;
            $candidatTable->save($candidat);

            $this->Flash->success('candidature enregistrée et en cours de traitement, Nous reviendrons vers vous rapidement');
            $this->redirect(['controller' => 'Melcom','action' => 'index']);

        }else{
            $this->Flash->error($message_received);
            $this->redirect(['controller' => 'Candidats','action' => 'payer', $candidat->id]);
        }

    }

    public function view(){
        $this->menu('postuler');
    }
}
