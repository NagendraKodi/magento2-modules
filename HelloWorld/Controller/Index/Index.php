<?php

namespace Orange\HelloWorld\Controller\Index;

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
            /*$data = $this->getRequest()->getParams();
            $model = $this->_postFactory->create();
            //  echo "pre:".print_r($data); exit;
						$name = $data['name'];
            if (isset($name) && !empty($name)) {
                $model->setName($data['name']);
                $model->save();
                $this->messageManager->addSuccess('Submited successfully.');
								$data = array();
								unset($data);
            }*/
            // $this->_redirect('helloworld');
            return $this->_pageFactory->create();
	}
}
