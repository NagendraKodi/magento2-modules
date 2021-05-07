<?php

namespace Orange\HelloWorld\Controller\Sample;

class Plugin extends \Magento\Framework\App\Action\Action
{

	protected $title;

	public function execute()
	{
		echo $this->setTitle('Welcome'); echo "</br>";
		echo $this->getTitle();          echo "</br>";   
	}

	public function setTitle($title)
	{
		return $this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}
}