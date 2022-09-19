<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Index;

use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Clearcart
 * @package Tigren\AdvancedCheckout\Controller\Index
 */
class Clearcart extends Action
{
    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @param Context $context
     * @param Cart $cart
     */
    public function __construct(
        Context $context,
        Cart    $cart
    ) {
        $this->cart = $cart;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|void
     */
    public function execute()
    {
        $allItems = $this->cart->getQuote()->getAllVisibleItems();
        foreach ($allItems as $item) {
            $itemId = $item->getItemId();
            $this->cart->removeItem($itemId)->save();

            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('/');
            return $resultRedirect;
        }
    }
}
