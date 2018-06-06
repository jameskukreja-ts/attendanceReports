<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendanceCsvsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendanceCsvsTable Test Case
 */
class AttendanceCsvsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendanceCsvsTable
     */
    public $AttendanceCsvs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendance_csvs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AttendanceCsvs') ? [] : ['className' => AttendanceCsvsTable::class];
        $this->AttendanceCsvs = TableRegistry::getTableLocator()->get('AttendanceCsvs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttendanceCsvs);

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
}
