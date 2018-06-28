<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendanceLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendanceLogsTable Test Case
 */
class AttendanceLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendanceLogsTable
     */
    public $AttendanceLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendance_logs',
        'app.employees',
        'app.modes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AttendanceLogs') ? [] : ['className' => AttendanceLogsTable::class];
        $this->AttendanceLogs = TableRegistry::getTableLocator()->get('AttendanceLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttendanceLogs);

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
