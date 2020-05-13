<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\Time;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 *
 * @method \App\Model\Entity\Project[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->authorize($this->Projects->newEmptyEntity());
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function list()
    {
        $this->viewBuilder()->setLayout('site');
        $user = $this->Authentication->getIdentity();
        $this->Authorization->authorize($this->Projects->newEmptyEntity());

        $this->paginate = [
            'conditions' => ['user_id' => $user->id],
        ];

        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects'));
    }    

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Users', 'Tags', 'Donations', 'Parts'],
        ]);
        $this->Authorization->authorize($project);

        $this->set('project', $project);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEmptyEntity();
        $this->Authorization->authorize($project);

        // Change the layout for common users
        $admin = $this->getRequest()->getSession()->read('admin');
        if(!$admin){
            $this->viewBuilder()->setLayout('site');
        }

        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            $project->user = $this->Authentication->getIdentity()->getOriginalData();
            $project->status = 1;
            $project->dateCreated = Time::now();

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                if(!$admin){
                    return $this->redirect(['action' => 'list']);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }

        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $tags = $this->Projects->Tags->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Change the layout/permission for common users
        $admin = $this->getRequest()->getSession()->read('admin');
        if(!$admin){
            $this->viewBuilder()->setLayout('site');
            $contain = [
                'contain' => ['Tags'],
                'conditions' => ['user_id'=>$this->Authentication->getIdentity()->getOriginalData()->id]
            ];            
        } else {
            $contain = [
                'contain' => ['Tags']
            ];
        }

        $project = $this->Projects->get($id, $contain);
        $this->Authorization->authorize($project);    

        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $tags = $this->Projects->Tags->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        $this->Authorization->authorize($project);

        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
