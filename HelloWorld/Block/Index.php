<?php
namespace Orange\HelloWorld\Block;
use Magento\Framework\Json\Helper\Data as jsondata;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;
        protected $_productloader; 
        
	public function __construct(
                jsondata $jsonHelper,
		\Orange\HelloWorld\Model\PostFactory $postFactory,
                \Magento\Catalog\Model\ProductFactory $_productloader,
                \Magento\Framework\View\Element\Template\Context $context,
                array $layoutProcessors = [],
                array $data = []
	)
	{   $this->jsonHelper = $jsonHelper;
		$this->_postFactory = $postFactory;
                $this->_productloader = $_productloader;
                $this->layoutProcessors = $layoutProcessors;
		parent::__construct($context, $data);
	}

	public function sayHello()
	{
		return __('Hello World');
	}

	public function getPostCollection(){
		$post = $this->_postFactory->create();
		return $post->getCollection();
	}
        
        public function getLoadProduct($id)
        {
            return $this->_productloader->create()->load($id);
        }
        /**
 
        * @return string

        */
        
        public function getPostCustomers()
	{   
            $model = $this->_postFactory->create()->getCollection();
            $data = $model->getData(); $result = array();            
            $i = 0;
            foreach($data as $v){ 
                $result[$i]['id'] = $data[$i]['id'];
                $result[$i]['name'] = $data[$i]['name'];
                $i++;
            } 
            return $this->jsonHelper->jsonEncode($result);
	}
        
        public function getLastId()
	{   
            $model = $this->_postFactory->create()->getCollection();
            $data = $model->getData(); $result='';
            $result = count($model);
            return $result;
	}

       public function getJsLayout()
       {
           foreach ($this->layoutProcessors as $processor) {
               $this->jsLayout = $processor->process($this->jsLayout);
           }
           return parent::getJsLayout();
       }
}
