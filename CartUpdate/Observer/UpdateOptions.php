<?php

namespace Orange\CartUpdate\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class UpdateOptions implements ObserverInterface
{
    public function __construct(
        RequestInterface $request
    )
    {
        $this->_request = $request;
    }

    public function execute(Observer $observer)
    {
        $cart = $observer->getCart();
        $cartData = $this->_request->getPost();
        foreach ($cartData['cart'] as $itemId => $itemInfo) {
            $item = $cart->getQuote()->getItemById($itemId);
            if (!$item)
                continue;

            if (!isset($itemInfo['super_attribute']) or empty($itemInfo['super_attribute']))
                continue;

            if ($item->getProduct()->getTypeId() == 'configurable') {
                $params = array(
                    'id' => $itemId,
                    'qty' => $itemInfo['qty'],
                    'product' => $item->getProduct()->getId(),
                    'super_attribute' => $itemInfo['super_attribute']
                );
                $cart->updateItem($itemId, new DataObject($params));
            }
        }
    }
}