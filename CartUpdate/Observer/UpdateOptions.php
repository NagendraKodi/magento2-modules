<?php

namespace Orange\CartUpdate\Observer;

class UpdateOptions implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->_request = $request;
    }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        $cart = $observer->getCart();
        $data = $observer->getEvent()->getInfo()->toArray();
        $cartData = $this->_request->getPost();
        foreach ($cartData['cart'] as $itemId => $itemInfo) 
        {
            $item = $cart->getQuote()->getItemById($itemId);
            if (!$item) 
                continue;

            if (!isset($itemInfo['super_attribute']) or empty($itemInfo['super_attribute'])) 
                continue;

            if ($item->getProduct()->getTypeId() == 'configurable')
            {
                $params = array(
                    'id' => $itemId,
                    'qty' => $itemInfo['qty'],
                    'product' => $item->getProduct()->getId(),
                    'super_attribute' => $itemInfo['super_attribute']
                );
                $cart->updateItem($itemId, new \Magento\Framework\DataObject($params));
            }
        } 
    }       
}