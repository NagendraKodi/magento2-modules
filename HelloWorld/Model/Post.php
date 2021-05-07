<?php
namespace Orange\HelloWorld\Model;
// for php unit testing
use \Magento\Framework\App\Bootstrap;
include('app/bootstrap.php');

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'orange_helloworld_post';

    protected function _construct()
    {
            $this->_init('Orange\HelloWorld\Model\ResourceModel\Post', 'id');
    }

    public function getIdentities()
    {
            return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
            $values = [];
            return $values;
    }

    // for php unit test
    public function getCustomer()
    {
        // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $bootstrap = Bootstrap::create(BP, $_SERVER);
        $objectManager = $bootstrap->getObjectManager();

        $url = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $url->get('\Magento\Store\Model\StoreManagerInterface');
        $mediaurl= $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $state = $objectManager->get('\Magento\Framework\App\State');
        $state->setAreaCode('frontend');

        // Customer Factory to Create Customer
        $customerFactory = $objectManager->get('\Magento\Customer\Model\CustomerFactory');
        $websiteId = $storeManager->getWebsite()->getWebsiteId();
        /// Get Store ID
        $store = $storeManager->getStore();
        $storeId = $store->getStoreId();

        // Instantiate object (this is the most important part)
        $customer = $customerFactory->create();
        $customer->setWebsiteId($websiteId);

        // Preparing data for new customer
        $customer->setEmail("nagendra13@test.com");
        $customer->setFirstname("nagendra13");
        $customer->setLastname("k");
        $customer->setPassword("reset123");
        $customer->save();
        /*$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/customer.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('id: '.$customer->getId());*/
        if ($customer->getId()) {
            //$logger->info('if: '.$customer->getId());
            $this->value = 1;
        }else{
            //$logger->info('else: '.$customer->getId());
            $this->value = 0;
        }
        return $this->value;
    }

}
