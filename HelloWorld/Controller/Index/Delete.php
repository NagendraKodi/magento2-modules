<?php
namespace Orange\HelloWorld\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
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
            $data = $this->getRequest()->getParams();
            if (isset($data['id'])) {
                try {
                $model = $this->_postFactory->create();
                $model->load($data['id']);
                $model->delete();
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                } 
            }
            $this->_redirect('helloworld');
            // return $this->_pageFactory->create();
	}
}