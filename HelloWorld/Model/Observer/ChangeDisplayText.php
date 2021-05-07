<?php

namespace Orange\HelloWorld\Model\Observer;

class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('mp_text');
        echo $displayText->getText() . "</br>Overriden content from event observer </br>";
        $displayText->setText('Execute event successfully.');
        return $this;
    }
}