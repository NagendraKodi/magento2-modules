<?php

namespace Orange\CartUpdate\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class UpdateOptions implements ObserverInterface
{

    /**
     * @var RequestInterface
     */
    public $request;

    /**
     * UpdateOptions constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        $cart = $observer->getEvent()->getCart();
        $cartData = $this->request->getPost();
        foreach ($cartData['cart'] as $itemId => $itemInfo) {
            $item = $cart->getQuote()->getItemById($itemId);
            if ($item->getProduct()->getTypeId() == 'configurable') {
                $params = [
                    'id' => $itemId,
                    'qty' => $itemInfo['qty'],
                    'product' => $item->getProduct()->getId(),
                    'super_attribute' => $itemInfo['super_attribute']
                ];
                $cart->updateItem($itemId, new DataObject($params));
            }
        }
    }
}
