<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Donations Controller
 *
 * @property \App\Model\Table\DonationsTable $Donations
 *
 * @method \App\Model\Entity\Donation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DonationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->authorize($this->Donations->newEmptyEntity());
        $this->paginate = [
            'contain' => ['Projects', 'Users'],
        ];
        $donations = $this->paginate($this->Donations);

        $this->set(compact('donations'));
    }

    /**
     * View method
     *
     * @param string|null $id Donation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $donation = $this->Donations->get($id, [
            'contain' => ['Projects', 'Users', 'Parts'],
        ]);
        $this->Authorization->authorize($donation);

        $this->set('donation', $donation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $donation = $this->Donations->newEmptyEntity();
        $this->Authorization->authorize($donation);

        if ($this->request->is('post')) {
            $donation = $this->Donations->patchEntity($donation, $this->request->getData());
            if ($this->Donations->save($donation)) {
                $this->Flash->success(__('The donation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The donation could not be saved. Please, try again.'));
        }
        $projects = $this->Donations->Projects->find('list', ['limit' => 200]);
        $users = $this->Donations->Users->find('list', ['limit' => 200]);
        $parts = $this->Donations->Parts->find('list', ['limit' => 200]);
        $this->set(compact('donation', 'projects', 'users', 'parts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Donation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $donation = $this->Donations->get($id, [
            'contain' => ['Parts'],
        ]);
        $this->Authorization->authorize($donation);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $donation = $this->Donations->patchEntity($donation, $this->request->getData());
            if ($this->Donations->save($donation)) {
                $this->Flash->success(__('The donation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The donation could not be saved. Please, try again.'));
        }
        $projects = $this->Donations->Projects->find('list', ['limit' => 200]);
        $users = $this->Donations->Users->find('list', ['limit' => 200]);
        $parts = $this->Donations->Parts->find('list', ['limit' => 200]);
        $this->set(compact('donation', 'projects', 'users', 'parts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Donation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $donation = $this->Donations->get($id);
        $this->Authorization->authorize($donation);
        
        if ($this->Donations->delete($donation)) {
            $this->Flash->success(__('The donation has been deleted.'));
        } else {
            $this->Flash->error(__('The donation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
