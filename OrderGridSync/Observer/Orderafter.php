<?php
namespace Orange\OrderGridSync\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\OrderRepositoryInterface;


class Orderafter implements ObserverInterface
{ 
    protected $orderRepository;
	
	/**
     * @var \Magento\Sales\Model\ResourceModel\Grid[]
     */
    protected $_grids;
    
    protected $_syncFactory; 
	
    public function __construct(
		OrderRepositoryInterface $OrderRepositoryInterface,
		\Magento\Sales\Model\ResourceModel\GridPool $grids,
        \Orange\OrderGridSync\Model\SyncFactory $syncFactory
    )
	{   
        $this->orderRepository = $OrderRepositoryInterface;
		$this->_grids = $grids;
        $this->_syncFactory = $syncFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) 
    {
        $writer = new \Zend\Log\Writer\Stream(BP.'/var/log/order-grid-map.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getId();           
        /*$this->_resources = \Magento\Framework\App\ObjectManager::getInstance()
        ->get('Magento\Framework\App\ResourceConnection');
        $connection= $this->_resources->getConnection();
        $customTable = $this->_resources->getTableName('affiliate');
        $sql = "INSERT INTO " . $customTable . "(order_id, affiliate_information) VALUES ($orderId, $orderId)";
        $connection->query($sql);*/
            $model = $this->_syncFactory->create();			
            $model->setId($orderId); $affiliateinformation = "order ".$orderId;
            $model->setAffiliateInformation($affiliateinformation);
            $model->save();
            /**
             * @var \Magento\Sales\Model\ResourceModel\Grid[]
             */
            $this->_grids->refreshByOrderId($orderId);
        $logger->info("order-grid-map sales_order_save_after order Id ===> ".$orderId);
    }
}