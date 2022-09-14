<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Checkout\Model\Cart;

class Clearcart extends Action
{

    protected $cart;

    public function __construct(
        Context $context,
        Cart $cart
    ) {
        $this->cart = $cart;
        parent::__construct($context);
    }

    public function execute()
    {
//        $objectManager = ObjectManager::getInstance();
//        $cart = $objectManager->get('Magento\Checkout\Model\Cart');
        $allItems = $this->cart->getQuote()->getAllVisibleItems();
        foreach ($allItems as $item) {
            $itemId = $item->getItemId();
            $this->cart->removeItem($itemId)->save();

            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('/'); // set this path to what you want your customer to go

            return $resultRedirect;
        }

    }

    public function removeCartById($itemId)
    {
//        $objectManager = ObjectManager::getInstance();
//        $cart = $objectManager->get('Magento\Checkout\Model\Cart');
//        $cart->removeItem($itemId)->save();
        // item removed successfully
    }
}
