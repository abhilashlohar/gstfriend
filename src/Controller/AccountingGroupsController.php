<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AccountingGroups Controller
 *
 * @property \App\Model\Table\AccountingGroupsTable $AccountingGroups
 *
 * @method \App\Model\Entity\AccountingGroup[] paginate($object = null, array $settings = [])
 */
class AccountingGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $this->paginate = [
            'contain' => ['Companies', 'NatureOfGroups', 'ParentAccountingGroups']
        ];
        $accountingGroups = $this->paginate($this->AccountingGroups);

        $this->set(compact('accountingGroups'));
        $this->set('_serialize', ['accountingGroups']);
		$this->set('active_menu', 'AccountingGroups.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Accounting Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$company_id=$this->Auth->User('company_id');
        $accountingGroup = $this->AccountingGroups->get($id, [
            'contain' => ['Companies', 'NatureOfGroups', 'ParentAccountingGroups', 'ChildAccountingGroups', 'Ledgers']
        ]);

        $this->set('accountingGroup', $accountingGroup);
        $this->set('_serialize', ['accountingGroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
        $accountingGroup = $this->AccountingGroups->newEntity();
        if ($this->request->is('post')) {
            $accountingGroup = $this->AccountingGroups->patchEntity($accountingGroup, $this->request->getData());
            if ($this->AccountingGroups->save($accountingGroup)) {
                $this->Flash->success(__('The accounting group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accounting group could not be saved. Please, try again.'));
        }
        $companies = $this->AccountingGroups->Companies->find('list');
        $natureOfGroups = $this->AccountingGroups->NatureOfGroups->find('list');
        $parentAccountingGroups = $this->AccountingGroups->ParentAccountingGroups->find('list');
        $this->set(compact('accountingGroup', 'companies', 'natureOfGroups', 'parentAccountingGroups'));
        $this->set('_serialize', ['accountingGroup']);
		$this->set('active_menu', 'AccountingGroups.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Accounting Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $accountingGroup = $this->AccountingGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountingGroup = $this->AccountingGroups->patchEntity($accountingGroup, $this->request->getData());
            if ($this->AccountingGroups->save($accountingGroup)) {
                $this->Flash->success(__('The accounting group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accounting group could not be saved. Please, try again.'));
        }
        $companies = $this->AccountingGroups->Companies->find()->where(['id'=>$company_id]);
        $natureOfGroups = $this->AccountingGroups->NatureOfGroups->find('list');
        $parentAccountingGroups = $this->AccountingGroups->ParentAccountingGroups->find('list');
        $this->set(compact('accountingGroup', 'companies', 'natureOfGroups', 'parentAccountingGroups'));
        $this->set('_serialize', ['accountingGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Accounting Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$company_id=$this->Auth->User('company_id');
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$accountingGroup = $this->AccountingGroups->get($id);
			$query = $this->AccountingGroups->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id,'company_id'=>$company_id])
					->execute();
			if ($this->AccountingGroups->save($accountingGroup)) {
				
				$this->Flash->success(__('The accounting group has been deleted.'));
			} else {
				$this->Flash->error(__('The accounting group could not be deleted. Please, try again.'));
			}
		}
    }   
}
