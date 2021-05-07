<?php

namespace Orange\TestPlugins2\Plugin;

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
        $logger->info('TestPlugins2 beforeGetProduct sortOrder=20'); // Simple Text Log
    }

    public function afterGetProduct(\Magento\Catalog\Block\Product\View $subject, $result)
    {
        // logging to test override
        //$logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        //$logger->debug(__METHOD__ . ' - ' . __LINE__);

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('TestPlugins2 afterGetProduct sortOrder=20'); // Simple Text Log
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
        $logger->info('TestPlugins2 aroundGetProduct sortOrder=20'); // Simple Text Log

        // logging to test override
        //$logger->debug(__METHOD__ . ' - ' . __LINE__);

        return $returnValue;
    }
}
?>
