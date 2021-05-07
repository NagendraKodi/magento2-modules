<?php
namespace Orange\OrderGridSync\Model\ResourceModel\Sync;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{      
        protected $_idFieldName = 'id';
	protected $_eventPrefix = 'affiliate';
	protected $_eventObject = 'sync_collection';
        
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Orange\OrderGridSync\Model\Sync', 'Orange\OrderGridSync\Model\ResourceModel\Sync');
	}

}
