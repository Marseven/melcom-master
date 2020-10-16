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



class CandidatsController extends AppController
{

    public function initialize(): void
    {

        parent::initialize();

        $this->loadComponent('Paginator');

        $this->Auth->allow(['index', 'add', 'view', 'payer']);
        $user = $this->Auth->user();

        if($user != null){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $usersTable->find()->contain(['Entreprises', 'Candidats'])->where(['id_user' => $user['id_user']])->first();
            $this->set('user', $user);
        }
    }

    public function index(){
        $candidatTable = TableRegistry::getTableLocator()->get('candidats');
        $candidats = $this->Paginator->paginate($candidatTable->find());

        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);

        $this->menu('postuler');
    }

    public function list(){
        $candidatTable = TableRegistry::getTableLocator()->get('candidats');
        $candidats = $this->Paginator->paginate($candidatTable->find());

        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);

        $this->menu('postuler');
    }

    public function annonceByCandidat($candidat)
    {
        $candidatTable = TableRegistry::getTableLocator()->get('Candidats');
        $query = $candidatTable->find()->contain(['Annonces'])->where(['id_candidat' => $candidat]);
        $candidats = $this->Paginator->paginate($query);
        $this->set(compact('candidats'));
        $this->set('_serialize', ['candidats']);
        $this->menu('annonces');
    }


    public function add(){
        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $annonces = $annonceTable->find()->all();
        $annonces = $this->tableAnc($annonces);

        $candidatTable = TableRegistry::getTableLocator()->get('candidats');
        $candidat = $candidatTable->newEntity([]);

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
                $file->moveTo("img/candidat/".$filename);
                $data['formations'] = $data['formations'][0].';'.$data['formations'][1].';'.$data['formations'][2];
                $data['experiences'] = $data['experiences'][0].';'.$data['experiences'][1].';'.$data['experiences'][2];
                $data['organisations'] = $data['organisations'][0].';'.$data['organisations'][1].';'.$data['organisations'][2];
                $candidat = $candidatTable->patchEntity($candidat, $data);

                //création du profil de connexion du candidat
                $mdp = AppController::str_random(6);
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
                    $candidat->id_user = $user->id_user;
                    if ($candidatTable->save($candidat)) {
                        $this->Flash->success(__('Votre candidat a été enregistré.'));
                        return $this->redirect(['action' => 'payer', $candidat->id_candidat]);
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
        $annonce_candidatTable = TableRegistry::getTableLocator()->get('annonces_candidats');

        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $annonces = $annonceTable->find()->all();
        $annonces = $this->tableAnc($annonces);

        $candidatTable = TableRegistry::getTableLocator()->get('candidats');
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
                $mdp = AppController::str_random(6);
                $user->nom = $candidat->nom;
                $user->email = $candidat->email;
                $exist_email = $candidat->find()
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
                $user->telephone = $candidat->telephone;
                $user->picture = $candidat->image;

                $usersTable->save($user);

                if ($usersTable->save($user)) {
                    if ($candidatTable->save($candidat)) {
                        $annonce_candidat = $annonce_candidatTable->newEntity([]);
                        $annonce_candidat->candidat_id = $candidat->id_candidat;
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
                $this->redirect(['action' => 'edit', $candidat->id_candidat]);
            }
        }

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);

        $this->menu('postuler');
    }

    public function payer($candidat){

        $candidatTable = TableRegistry::getTableLocator()->get('candidats'); $candidatTable = TableRegistry::getTableLocator()->get('candidats');
        $candidat = $candidatTable->find()->contain('Annonces')->where(['id_candidat' => $candidat])->all();

        $candidat = $candidat->first();


        if(isset($this->request->getQuery()['payer']) && $this->request->getQuery()['payer'] == 'true'){
            // =============================================================
            // ===================== Setup Attributes ======================
            // =============================================================
            // E-Billing server URL

            $SERVER_URL = 'http://lab.billing-easy.net/api/v1/merchant/e_bills';

            // Username
            $USER_NAME = 'aristide'; //'aristide';//

            // SharedKey
            $SHARED_KEY = 'a4e80739-61ea-430e-8ddc-db9eb7bf0783'; //a4e80739-61ea-430e-8ddc-db9eb7bf0783

            // POST URL
            $POST_URL = 'http://sandbox.billing-easy.net';


            // Fetch all data (including those not optional) from session
            $eb_amount = 3000;
            $eb_shortdescription = 'Paiement de l\'abonnement 3000 FCFA.';
            $eb_reference = $this->str_random(6);
            $eb_email = $candidat->email;
            $eb_msisdn = $candidat->telephone;
            $eb_name = $candidat->nom;
            $eb_address = $candidat->adresse;
            $eb_city = $candidat->adresse;
            $eb_detaileddescription = 'Paiement de l\'abonnement 3000 FCFA.';
            $eb_additionalinfo = '';
            $eb_callbackurl = 'http://localhost/melcom/candidats/paiementSucces?candidat='.$candidat->id_candidat;

            // =============================================================
            // ============== E-Billing server invocation ==================
            // =============================================================
            $global_array =
                [
                    'payer_email' => $eb_email,
                    'payer_msisdn' => $eb_msisdn,
                    'amount' => $eb_amount,
                    'short_description' => $eb_shortdescription,
                    'description' => $eb_detaileddescription,
                    'due_date' => date('d/m/Y', time() + 86400),
                    'external_reference' => $eb_reference,
                    'payer_name' => $eb_name,
                    'payer_address' => $eb_address,
                    'payer_city' => $eb_city,
                    'additional_info' => $eb_additionalinfo
                ];

            $content = json_encode($global_array);
            $curl = curl_init($SERVER_URL);
            curl_setopt($curl, CURLOPT_USERPWD, $USER_NAME . ":" . $SHARED_KEY);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            $json_response = curl_exec($curl);

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ( $status != 201 ) {
                var_dump("Error: call to URL  failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));die;
                $this->Flash->error("Error: call to URL  failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                //$this->Flash->error('Erreur $status eBilling Payment');
                $this->redirect(['controller' => 'Melcom', 'action' => 'index']);
            }
            $date = date('Y-m-d H:m:s');
            $connection = ConnectionManager::get('default');
            $results = $connection
                ->execute(
                    'INSERT INTO paiement (email, phone, amount_order, description, date, external_reference, first_name, last_name, address, city, etat)
					 VALUES ("'.$global_array['payer_email'].'","'.$global_array['payer_msisdn'].'","'.$global_array['amount'].'","'.$global_array['short_description'].'","'.$date.'","'.$global_array['external_reference'].'","'.$candidat->nom.'","'.$candidat->nom.'","'.$global_array['payer_address'].'","'.$global_array['payer_city'].'","En Cours")
					'
                );

            curl_close($curl);

            $response = json_decode($json_response, true);

            $url = "http://localhost/post.php?invoice_number=".$response['e_bill']['bill_id']."&eb_callbackurl=".$eb_callbackurl;

            return $this->redirect($url);
        }

        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);

        $this->menu('postuler');

    }

    public function paiementSucces(){
        $candidatTable = TableRegistry::getTableLocator()->get('candidats'); $candidatTable = TableRegistry::getTableLocator()->get('candidats');
        $candidat = $candidatTable->get($this->request->getQuery()['candidat']);

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
        $this->Flash->success('candidature enregistrée, Nous reviendrons vers vous rapidement');
        $this->redirect(['controller' => 'Melcom','action' => 'index']);

    }

    public function view(){
        $this->menu('postuler');
    }
}
