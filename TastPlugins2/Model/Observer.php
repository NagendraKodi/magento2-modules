<?php
namespace Orange\TastPlugins2\Model;

class Observer implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/events.log');
      $logger = new \Zend\Log\Logger();
      $logger->addWriter($writer);
      $logger->info('TastPlugins2 controller_action_predispatch'); // Simple Text Log
    }
}
