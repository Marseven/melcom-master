<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Annonces Controller
 *
 * @property \App\Model\Table\AnnoncesTable $Annonces
 */
class AnnoncesController extends AppController
{

  public function initialize() : void
  {
      parent::initialize();
      $this->loadComponent('Paginator');

      $this->Auth->allow(['index', 'view']);
      $user = $this->Auth->user();
      if($user){
          $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
          $user['reset_at'] = new FrozenTime($user['reset_at']);
          $usersTable = TableRegistry::getTableLocator()->get('Users');
          $user = $usersTable->find()->contain(['Entreprises', 'Candidats'])->where(['id' => $user['id']])->first();
          $this->set('user', $user);
      }

  }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $annonces = $this->Paginator->paginate($annonceTable->find()->contain(['Categories', 'Entreprises']));
        $categorieTable = TableRegistry::getTableLocator()->get('categories');
        $categories = $categorieTable->find()->contain(['Annonces'])->all();

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);

        $this->menu('annonces');
        $this->render('index');
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $annonce = $this->Annonces->get($id, [
            'contain' => ['categories']
        ]);

        $this->set(compact('contact'));
        $this->set('annonce', $annonce);
        $this->set('_serialize', ['annonce']);
        $this->menu('annonces');
    }

    public function list()
    {
        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $annonces = $this->Paginator->paginate($annonceTable->find()->contain(['Categories', 'Entreprises']));

        $this->set(compact('annonces'));
        $this->set('_serialize', ['annonces']);

        $this->menu('annonces');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $annonce_categorieTable = TableRegistry::getTableLocator()->get('annonces_categories');
        $categorieTable = TableRegistry::getTableLocator()->get('categories');
        $annonceTable = TableRegistry::getTableLocator()->get('annonces');
        $entrepriseTable = TableRegistry::getTableLocator()->get('entreprises');

        $annonce = $annonceTable->newEntity([]);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $file = $data['image'];
            $filename = $file->getClientFilename();
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $good_ext = in_array($extension, ['png', 'jpg', 'jpeg']);
            if($good_ext && $filename != ''){
                $data['image'] = $filename;
                $file->moveTo("img/annonce/".$filename);
                $annonce = $annonceTable->patchEntity($annonce, $data);

                if ($this->Annonces->save($annonce)) {
                    $annonce_categorie = $annonce_categorieTable->newEntity([]);
                    $annonce_categorie->category_id = $this->request->getData()["id_categorie"];
                    $annonce_categorie->annonce_id = $annonce->id_annonce;
                    $annonce_categorieTable->save($annonce_categorie);

                    $this->Flash->success(__('Votre annonce a été enregistrée et publiée.'));
                    return $this->redirect(['action' => 'edit', $annonce->id_annonce]);
                } else {
                    $this->Flash->error(__('Votre annonce ne peut pas être enregistrée. s\'il vous plaît, essyez plus tard.'));
                }
            }else{
                $this->set(compact('annonce'));
                $this->set('_serialize', ['annonce']);
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                $this->redirect(['action' => 'add']);
            }

        }
        $this->set(compact('annonce'));
        $this->set('_serialize', ['annonce']);

        $categories = $this->tableCat($categorieTable->find()->all());
        $this->set(compact('categories'));

        $this->set('entreprises', $this->tableEnt($entrepriseTable->find()->all()));

        $this->menu('annonces');
        $this->render('add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      $annonce_categorieTable = TableRegistry::getTableLocator()->get('annonces_categories');
      $categorieTable = TableRegistry::getTableLocator()->get('categories');
      $annonceTable = TableRegistry::getTableLocator()->get('annonces');
      $entrepriseTable = TableRegistry::getTableLocator()->get('entreprises');


      $annonce = $annonceTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $file = $data['image'];
            $filename = $file->getClientFilename();
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $good_ext = in_array($extension, ['png', 'jpg', 'jpeg']);
            if($good_ext && $filename != ''){
                $data['image'] = $filename;
                $file->moveTo("img/annonce/".$filename);
                $annonce_edit = $annonceTable->patchEntity($annonce, $data);

                if ($annonceTable->save($annonce_edit)) {
                    $annonce_categorie = $annonce_categorieTable->newEntity([]);
                    $annonce_categorie->category_id = $this->request->getData()["id_categorie"];
                    $annonce_categorie->annonce_id = $annonce->id_annonce;
                    $cat_exist = $annonce_categorieTable->find()
                        ->where(
                            [
                                'category_id' => $annonce_categorie->category_id,
                                'annonce_id' => $annonce_categorie->annonce_id
                            ]
                        )
                        ->limit(1)
                        ->all();
                    if($cat_exist->first() == null){$annonce_categorieTable->save($annonce_categorie);}

                    $this->Flash->success(__('Votre annonce a été modifiée.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Votre annonce ne peut pas être modifiée. s\'il vous plaît, essyez plus tard.'));
                }
            }else{
                $this->set(compact('annonce'));
                $this->set('_serialize', ['annonce']);
                $this->Flash->error('Mauvais type de fichier importé. Type correct : jpg, png, jpeg');
                $this->redirect(['action' => 'add']);
            }
        }



        $this->set('edit_annonce', $annonce);
        $this->set('_serialize', ['edit_annonce']);

        $categories = $this->tableCat($categorieTable->find()->all());
        $this->set(compact('categories'));

        $this->set('entreprises', $this->tableEnt($entrepriseTable->find()->all()));

        $this->menu('annonces');
        $this->render('edit');
    }

    public function moderer(){
        if(!empty($this->request->params['?']['iid']))
        {
            $iid=intval($this->request->params['?']['iid']);
            $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
            $annonce = $annonceTable->get($iid);
            $annonce->status = 0;
            $this->Flash->success('Article mis en brouillon avec succès');
            $this->redirect(['prefix' => 'admin', 'controller' => 'Annonces', 'action' => 'index']);
        }

        if(!empty($this->request->params['?']['aid']))
        {
            $aid=intval($this->request->params['?']['aid']);
            $annonceTable = TableRegistry::getTableLocator()->get('Annonces');
            $annonce = $annonceTable->get($aid);
            $annonce->status = 1;
            $this->Flash->success('Article publié avec succès');
            $this->redirect(['prefix' => 'admin', 'controller' => 'Annonces', 'action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $annonce = $this->Annonces->get($id);
        if ($this->Annonces->delete($annonce)) {
            $this->Flash->success(__('Votre annonce a été supprimé.'));
        } else {
            $this->Flash->error(__('Votre annonce ne peut pas être supprimé. s\'il vous plaît, essyez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
