<?php 
namespace Orange\HelloWorld\Test\Unit\Model;
use \Magento\Framework\App\Bootstrap;
 
class PostTest extends \PHPUnit_Framework_TestCase {

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
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $postFactory = $objectManager->getObject('Orange\HelloWorld\Model\Post');
        
        /*$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/customer.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);*/
        $this->value = $postFactory->getCustomer();
        
        //$logger->info('customer test called: '.$this->value); 
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
    public function testTest()
    {   
        /*$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('setUp: '.$this->setUp());*/
              
        $this->assertTrue($this->value == 1);
    }
}
?>