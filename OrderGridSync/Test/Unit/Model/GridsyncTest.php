<?php
namespace Orange\OrderGridSync\Test\Unit\Model;
use \Magento\Framework\App\Bootstrap;
use \Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use \Magento\Sales\Model\ResourceModel\GridPool;
use \Orange\OrderGridSync\Model\Gridsync;

class GridsyncTest extends \PHPUnit\Framework\TestCase {

    /**
     * Is called once before running all test in class
     */
    static function setUpBeforeClass()
    {

    }

    /**
     * Is called once after running all test in class
     */
    static function tearDownAfterClass()
    {

    }

    /**
     * Is called before running a test
     */
    protected function setUp()
    {
        $this->objectManager = new ObjectManager($this);
        $this->gridPoolMock = $this->createMock(\Magento\Sales\Model\ResourceModel\GridPool::Class);
        $this->syncFactoryMock = $this->createMock(\Orange\OrderGridSync\Model\SyncFactory::Class);
		$this->syncMock = $this->createMock(\Orange\OrderGridSync\Model\Sync::Class);
        $this->model = $this->objectManager->getObject(
                \Orange\OrderGridSync\Model\Gridsync::Class,[
                    'gridPool' => $this->gridPoolMock,
                    'syncFactory' => $this->syncFactoryMock                    
                ]
                );
    }

    /**
     * Is called after running a test
     */
    protected function tearDown()
    {

    }

    /**
     * The test itself, every test function must start with 'test'
     */
    public function testSyncOrders()
    {
		// two test cases 1. new id, 2.allready existing id.
        $orderids = array(array(
                                    'id' => '80',
                                    'affiliate_information' => 'order 80'
                                )
                        );				
		$this->syncFactoryMock->method('create')->willReturn($this->syncMock);
        $this->value = $this->model->syncOrders($orderids);
        $this->assertTrue($this->value == "Successfully Synced.");
    }
}
?>
