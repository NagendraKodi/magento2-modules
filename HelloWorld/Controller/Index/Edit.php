<?php

namespace Orange\HelloWorld\Controller\Index;

class Edit extends \Magento\Framework\App\Action\Action
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
        if (isset($_POST['name']) && isset($_POST['id'])) {
            $id = $_POST['id']; $name = $_POST['name'];
            $data2 = array('name'=> $name);
            $model = $this->_postFactory->create()->load($id)->addData($data2);
            try {
                $model->setId($id)->save();
                $this->_redirect('helloworld');
            } catch (Exception $e){
                echo $e->getMessage(); 
            }                
        }
        return $this->_pageFactory->create();
    }
}