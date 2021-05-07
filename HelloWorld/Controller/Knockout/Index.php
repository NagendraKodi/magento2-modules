<?php

namespace Orange\HelloWorld\Controller\Knockout;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
        protected $_postFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
                \Orange\HelloWorld\Model\PostFactory $postFactory
                )
	{
		$this->_pageFactory = $pageFactory;
                $this->_postFactory = $postFactory;

		return parent::__construct($context);
	}

	public function execute()
	{   
            $model = $this->_postFactory->create()->getCollection();
            $data = $model->getData(); $result = array();
            return $this->_pageFactory->create();
            // $this->_redirect('helloworld/knockout/index');
	}
        
}