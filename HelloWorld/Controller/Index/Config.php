<?php

namespace Orange\HelloWorld\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{

	protected $helperData;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Orange\HelloWorld\Helper\Data $helperData

	)
	{
		$this->helperData = $helperData;
		return parent::__construct($context);
	}

	public function execute()
	{   
            echo "Default values:"; echo "<br>";
            echo "enable:".$this->helperData->getGeneralConfig('enable'); echo "<br>";
            echo "display_text".$this->helperData->getGeneralConfig('display_text'); echo "<br><br>";
            
            echo "enable:".$this->helperData->getStatus(); echo "<br>";
            echo "display_text:".$this->helperData->getDisplyText(); echo "<br>";
            exit;
        }
}
