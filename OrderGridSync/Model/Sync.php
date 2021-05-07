<?php
namespace Orange\OrderGridSync\Model;

class Sync extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
   
    const CACHE_TAG = 'affiliate';
    protected $_cacheTag = 'affiliate';
    protected $_eventPrefix = 'affiliate';
    

    protected function _construct()
    {
        $this->_init('Orange\OrderGridSync\Model\ResourceModel\Sync');
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
}
