<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AccountingEntries Controller
 *
 * @property \App\Model\Table\AccountingEntriesTable $AccountingEntries
 *
 * @method \App\Model\Entity\AccountingEntry[] paginate($object = null, array $settings = [])
 */
class AccountingEntriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		$accountingEntries = $this->AccountingEntries->newEntity();
        $start= $this->request->data('start');
        $end= $this->request->data('end');
        //pr($start);
		if ($this->request->is('post')) {

		$StartDate =  date('Y-m-d',strtotime($start));
		$EndDate =  date('Y-m-d',strtotime($end));
			
		$accountingEntries['PurchaseVouchers'] = $this->AccountingEntries->PurchaseVouchers->find()
		->contain(['PurchaseVoucherRows'=>['CgstLedger','SgstLedger','IgstLedger','Items']])
		->where(['PurchaseVouchers.transaction_date BETWEEN :start AND :end' ,'PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status'=>0])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['PurchaseVouchers.id'=>'DESC']);		
		
		
		$accountingEntries['Invoices'] = $this->AccountingEntries->Invoices->find()
		->contain(['InvoiceRows'=>['TaxCGST','TaxSGST','TaxIGST','Items'],'CustomerLedgers'=>['Customers']])
		->where(['Invoices.transaction_date BETWEEN :start AND :end','Invoices.company_id'=>$company_id ,'Invoices.status'=>0])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['Invoices.id'=>'DESC']);
		
		}
		$items = $this->AccountingEntries->Items->find('list')->where(['freezed'=>0,'company_id'=>$company_id,'status'=>0]);
		//pr($end);   
		//pr($accountingEntries['PurchaseVouchers']->toArray());exit;
        $this->set(compact('accountingEntries','url','start','end','items'));
        $this->set('_serialize', ['accountingEntries']);
    }
	
	
	
	//item wise filter start
	function itemfilter($itemwise,$start,$end)
	{  
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		$company_id=$this->Auth->User('company_id');
		$StartDate =  date('Y-m-d',strtotime($start));
		$EndDate =  date('Y-m-d',strtotime($end));
		 $PurchaseVouchers = $this->AccountingEntries->PurchaseVouchers->find()
		->contain(['SupplierLedger'=>['Suppliers'],'PurchaseVoucherRows'=>function($q) use($itemwise){   
				return $q->where(['PurchaseVoucherRows.item_id'=>$itemwise])->contain(['CgstLedger','SgstLedger','IgstLedger','Items']);
				}])
					->where(['PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0,'PurchaseVouchers.transaction_date BETWEEN :start AND :end'])
					->bind(':start', $StartDate, 'date')
					->bind(':end',   $EndDate, 'date')
					->order(['PurchaseVouchers.id'=>'DESC'])
					->toArray();	
		
		  
		$Invoices = $this->AccountingEntries->Invoices->find()
		->contain(['CustomerLedgers'=>['Customers'],'InvoiceRows'=>function($q) use($itemwise){   
			return $q->where(['InvoiceRows.item_id'=>$itemwise])->contain(['TaxCGST','TaxSGST','TaxIGST','Items']);
			}])
				->where(['Invoices.transaction_date BETWEEN :start AND :end','Invoices.company_id'=>$company_id,'Invoices.status' => 0])
				->bind(':start', $StartDate, 'date')
				->bind(':end',   $EndDate, 'date')
				->order(['Invoices.id'=>'DESC'])
				->toArray();
											
		
		
        $this->set(compact('PurchaseVouchers','Invoices','url','itemwise','start','end'));
		
	}
	
	//item wise filter end
	
	//generate excel item wise start
	 public function itemWiseExcel($itemwise,$start,$end)
    {   
		$company_id=$this->Auth->User('company_id');
		$StartDate =  date('Y-m-d',strtotime($start));
		$EndDate =  date('Y-m-d',strtotime($end));
		 $PurchaseVouchers = $this->AccountingEntries->PurchaseVouchers->find()
		->contain(['SupplierLedger'=>['Suppliers'],'PurchaseVoucherRows'=>function($q) use($itemwise){   
				return $q->where(['PurchaseVoucherRows.item_id'=>$itemwise])->contain(['CgstLedger','SgstLedger','IgstLedger','Items']);
				}])
					->where(['PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0,'PurchaseVouchers.transaction_date BETWEEN :start AND :end'])
					->bind(':start', $StartDate, 'date')
					->bind(':end',   $EndDate, 'date')
					->order(['PurchaseVouchers.id'=>'DESC'])
					->toArray();	
		
		  
		$Invoices = $this->AccountingEntries->Invoices->find()
		->contain(['CustomerLedgers'=>['Customers'],'InvoiceRows'=>function($q) use($itemwise){   
			return $q->where(['InvoiceRows.item_id'=>$itemwise])->contain(['TaxCGST','TaxSGST','TaxIGST','Items']);
			}])
				->where(['Invoices.transaction_date BETWEEN :start AND :end','Invoices.company_id'=>$company_id,'Invoices.status' => 0])
				->bind(':start', $StartDate, 'date')
				->bind(':end',   $EndDate, 'date')
				->order(['Invoices.id'=>'DESC'])
				->toArray();
											
		
		
        $this->set(compact('PurchaseVouchers','Invoices','url','itemwise'));
	}
	
	
	
	
	
	//generate index excel start
	 public function exportExcel($start,$end)
    {
		$this->viewBuilder()->layout('');
		$company_id=$this->Auth->User('company_id');
		
		$StartDate =  date('Y-m-d',strtotime($start));
		$EndDate =  date('Y-m-d',strtotime($end));
			$accountingEntries['PurchaseVouchers'] = $this->AccountingEntries->PurchaseVouchers->find()
			->contain(['PurchaseVoucherRows'=>['CgstLedger','SgstLedger','IgstLedger','Items']])
			->where(['PurchaseVouchers.transaction_date BETWEEN :start AND :end' ,'PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status'=>0])
			->bind(':start', $StartDate, 'date')
			->bind(':end',   $EndDate, 'date')
			->order(['PurchaseVouchers.id'=>'DESC']);		
			
			
			$accountingEntries['Invoices'] = $this->AccountingEntries->Invoices->find()
			->contain(['InvoiceRows'=>['TaxCGST','TaxSGST','TaxIGST','Items'],'CustomerLedgers'=>['Customers']])
			->where(['Invoices.transaction_date BETWEEN :start AND :end','Invoices.company_id'=>$company_id ,'Invoices.status'=> 0])
			->bind(':start', $StartDate, 'date')
			->bind(':end',   $EndDate, 'date')
			->order(['Invoices.id'=>'DESC']);
		
		//pr($accountingEntries['PurchaseVouchers']->toArray());exit;
        $this->set(compact('accountingEntries'));
        $this->set('_serialize', ['accountingEntries']);
	}
	//generate index excel end
	
	
	
	
	

    /**
     * View method
     *
     * @param string|null $id Accounting Entry id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accountingEntry = $this->AccountingEntries->get($id, [
            'contain' => ['Ledgers', 'PurchaseVouchers', 'Companies', 'Invoices']
        ]);

        $this->set('accountingEntry', $accountingEntry);
        $this->set('_serialize', ['accountingEntry']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accountingEntry = $this->AccountingEntries->newEntity();
        if ($this->request->is('post')) {
            $accountingEntry = $this->AccountingEntries->patchEntity($accountingEntry, $this->request->getData());
            if ($this->AccountingEntries->save($accountingEntry)) {
                $this->Flash->success(__('The accounting entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accounting entry could not be saved. Please, try again.'));
        }
        $ledgers = $this->AccountingEntries->Ledgers->find('list', ['limit' => 200]);
        $purchaseVouchers = $this->AccountingEntries->PurchaseVouchers->find('list', ['limit' => 200]);
        $companies = $this->AccountingEntries->Companies->find('list', ['limit' => 200]);
        $invoices = $this->AccountingEntries->Invoices->find('list', ['limit' => 200]);
        $this->set(compact('accountingEntry', 'ledgers', 'purchaseVouchers', 'companies', 'invoices'));
        $this->set('_serialize', ['accountingEntry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Accounting Entry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accountingEntry = $this->AccountingEntries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountingEntry = $this->AccountingEntries->patchEntity($accountingEntry, $this->request->getData());
            if ($this->AccountingEntries->save($accountingEntry)) {
                $this->Flash->success(__('The accounting entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accounting entry could not be saved. Please, try again.'));
        }
        $ledgers = $this->AccountingEntries->Ledgers->find('list', ['limit' => 200]);
        $purchaseVouchers = $this->AccountingEntries->PurchaseVouchers->find('list', ['limit' => 200]);
        $companies = $this->AccountingEntries->Companies->find('list', ['limit' => 200]);
        $invoices = $this->AccountingEntries->Invoices->find('list', ['limit' => 200]);
        $this->set(compact('accountingEntry', 'ledgers', 'purchaseVouchers', 'companies', 'invoices'));
        $this->set('_serialize', ['accountingEntry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Accounting Entry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accountingEntry = $this->AccountingEntries->get($id);
        if ($this->AccountingEntries->delete($accountingEntry)) {
            $this->Flash->success(__('The accounting entry has been deleted.'));
        } else {
            $this->Flash->error(__('The accounting entry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
