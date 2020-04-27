<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 *
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->authorize($this->Parts->newEmptyEntity());
        $this->paginate = [
            'contain' => ['Projects'],
        ];
        $parts = $this->paginate($this->Parts);

        $this->set(compact('parts'));
    }

    /**
     * View method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['Projects', 'Donations', 'Tags'],
        ]);
        $this->Authorization->authorize($part);

        $this->set('part', $part);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $part = $this->Parts->newEmptyEntity();
        $this->Authorization->authorize($part);
        if ($this->request->is('post')) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The part has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The part could not be saved. Please, try again.'));
        }
        $projects = $this->Parts->Projects->find('list', ['limit' => 200]);
        $donations = $this->Parts->Donations->find('list', ['limit' => 200]);
        $tags = $this->Parts->Tags->find('list', ['limit' => 200]);
        $this->set(compact('part', 'projects', 'donations', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['Donations', 'Tags'],
        ]);
        $this->Authorization->authorize($part);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The part has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The part could not be saved. Please, try again.'));
        }
        $projects = $this->Parts->Projects->find('list', ['limit' => 200]);
        $donations = $this->Parts->Donations->find('list', ['limit' => 200]);
        $tags = $this->Parts->Tags->find('list', ['limit' => 200]);
        $this->set(compact('part', 'projects', 'donations', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $part = $this->Parts->get($id);
        $this->Authorization->authorize($part);
        
        if ($this->Parts->delete($part)) {
            $this->Flash->success(__('The part has been deleted.'));
        } else {
            $this->Flash->error(__('The part could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
