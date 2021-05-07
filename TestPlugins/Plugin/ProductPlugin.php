<?php

namespace Orange\TestPlugins\Plugin;

class ProductPlugin
{
    public function beforeGetProduct(\Magento\Catalog\Block\Product\View $subject)
    {
      // logging to test override
     //$logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
     //$logger->debug(__METHOD__ . ' - ' . __LINE__);

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('beforeGetProduct sortOrder=10'); // Simple Text Log
    }

    public function afterGetProduct(\Magento\Catalog\Block\Product\View $subject, $result)
    {
        // logging to test override
        //$logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        //$logger->debug(__METHOD__ . ' - ' . __LINE__);

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('afterGetProduct sortOrder=10'); // Simple Text Log
        return $result;
    }

    public function aroundGetProduct(\Magento\Catalog\Block\Product\View $subject, \Closure $proceed)
    {
        // logging to test override
          //$logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
          //$logger->debug(__METHOD__ . ' - ' . __LINE__);

        // call the core observed function
        $returnValue = $proceed();

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('aroundGetProduct sortOrder=10'); // Simple Text Log

        // logging to test override
        //$logger->debug(__METHOD__ . ' - ' . __LINE__);

         return $returnValue;
    }
}
?>
