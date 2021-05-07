<?php
 
namespace Orange\HelloWorld\Helper\Catalog;
 
class Data extends \Magento\Catalog\Helper\Data
{    
    /**
     * Retrieve current Product object
     *
     * @return \Magento\Catalog\Model\Product|null
     */
    public function getProduct()
    {
        // logging to test override    
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug('Helper Override Test');
        
        return $this->_coreRegistry->registry('current_product');
    }
}
?>