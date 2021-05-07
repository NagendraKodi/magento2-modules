<?php
namespace Orange\HelloWorld\Model\Observer;

class Customersaveafter implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        echo "</br> Customersaveafter </br>";
        $event = $observer->getEvent();
        $customer = $event->getCustomer();
        echo "email:".$email = $customer->getEmail(); echo "<br>";
        echo "id:".$customerId = $customer->getId(); echo "<br>";
    }
}
