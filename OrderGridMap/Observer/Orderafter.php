<?php
namespace Orange\OrderGridMap\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Grid;

class Orderafter implements ObserverInterface
{ 

    protected $orderRepository;

    public function __construct(
            OrderRepositoryInterface $OrderRepositoryInterface 
            )
    {   
        $this->orderRepository = $OrderRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) 
    {
        $writer = new \Zend\Log\Writer\Stream(BP.'/var/log/order-grid-map.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getId();           
        $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()
        ->get('Magento\Framework\App\ResourceConnection');
        $connection= $this->_resources->getConnection();
        $customTable = $this->_resources->getTableName('affiliate');
        $sql = "INSERT INTO " . $customTable . "(order_id, affiliate_information) VALUES ($orderId, $orderId)";
        $connection->query($sql);
        $logger->info("sales_order_save_after order Id ===> ".$orderId);
    }
}