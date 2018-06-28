<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SharedComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SharedComponent Test Case
 */
class SharedComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\SharedComponent
     */
    public $Shared;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Shared = new SharedComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Shared);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
