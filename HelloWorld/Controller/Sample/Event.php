<?php
namespace Orange\HelloWorld\Controller\Sample;

class Event extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;

    public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory
            )
    {
            $this->_pageFactory = $pageFactory;
            return parent::__construct($context);
    }

    public function execute()
	{
            $textDisplay = new \Magento\Framework\DataObject(array('text' => 'Original content from controller'));
            $this->_eventManager->dispatch('helloworld_display_text', ['mp_text' => $textDisplay]);
	}
        
}