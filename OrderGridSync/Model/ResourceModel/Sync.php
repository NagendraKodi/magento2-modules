<?php
namespace Orange\OrderGridSync\Model\ResourceModel;


class Sync extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
        protected $_isPkAutoIncrement = false;

	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}

	protected function _construct()
	{
		$this->_init('affiliate', 'id');
	}

}