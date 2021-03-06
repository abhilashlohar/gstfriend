<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LedgerAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LedgerAccountsTable Test Case
 */
class LedgerAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LedgerAccountsTable
     */
    public $LedgerAccounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ledger_accounts',
        'app.companies',
        'app.suppliers',
        'app.customers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LedgerAccounts') ? [] : ['className' => LedgerAccountsTable::class];
        $this->LedgerAccounts = TableRegistry::get('LedgerAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LedgerAccounts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
