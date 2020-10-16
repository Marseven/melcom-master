<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
{

  public function initialize() : void
  {
      parent::initialize();
      $this->loadComponent('Paginator');
      $user = $this->Auth->user();
      if($user != null){
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
    public function index($id = null)
    {

        $categories = $this->paginate($this->Categories);
        if($id != null){
            $category = $this->Categories->get($id);
        }else{
            $category = $this->Categories->newEntity([]);
        }

        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
        $this->menu('annonces');
        $this->render('index');
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edit_category = $this->Categories->get($id);

        $this->set('edit_category', $edit_category);
        $this->set('_serialize', ['edit_category']);

        $categories = $this->paginate($this->Categories);
        $category = $this->Categories->newEntity();
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
        $this->render('view');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity([]);
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('La catégorie a été enregistré.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La catégorie n\'a pas été enregistré. S\'il vous plaît essayez plus tard.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('La catégorie a été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La catégorie n\'a pas été modifié. S\'il vous plaît essayez plus tard.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Categorie id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('La catégorie a été supprimée.'));
        } else {
            $this->Flash->error(__('La catégorie ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $category = $this->Categories->get($id);
        if ($this->Categories->moveUp($category)) {
            $this->Flash->success('The category has been moved Up.');
        } else {
            $this->Flash->error('The category could not be moved up. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $category = $this->Categories->get($id);
        if ($this->Categories->moveDown($category)) {
            $this->Flash->success('The category has been moved down.');
        } else {
            $this->Flash->error('The category could not be moved down. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}
