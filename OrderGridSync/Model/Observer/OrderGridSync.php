<?php

namespace Orange\OrderGridSync\Model\Observer;

class OrderGridSync implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('mn_text');
        echo $displayText->getText() . "</br>Overriden content from event observer </br>";
        $displayText->setText('Execute event successfully.');
        return $this;
    }
}