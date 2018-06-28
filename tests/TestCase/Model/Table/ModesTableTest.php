<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModesTable Test Case
 */
class ModesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ModesTable
     */
    public $Modes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.modes',
        'app.machine_modes',
        'app.attendance_logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Modes') ? [] : ['className' => ModesTable::class];
        $this->Modes = TableRegistry::getTableLocator()->get('Modes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Modes);

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
