<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Result\PageFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory;

class Check extends Action
{
    protected $_session;

    protected $PageFactory;
    protected $RuleFactory;

    public function __construct(
        Context $context,
        Session $session,
        PageFactory $pageFactory,
        CollectionFactory $ruleFactory,
    ) {
        parent::__construct($context);
        $this->_session = $session;

        $this->PageFactory = $pageFactory;
        $this->RuleFactory = $ruleFactory;
    }

    public function execute()
    {
        $objectManager = ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        // get quote items collection
        $itemsCollection = $cart->getQuote()->getItemsCollection();

        // get array of all items what can be display directly
        $itemsVisible = $cart->getQuote()->getAllVisibleItems();

        // get quote items array
        $items = $cart->getQuote()->getAllItems();

        foreach ($items as $item) {
            echo "<pre>";
//            print_r($item->getData());
            echo 'ID: '.$item->getProductId().'<br />';
//            echo 'Name: '.$item->getName().'<br />';
            echo 'Sku: '.$item->getSku().'<br />';
//            echo 'Quantity: '.$item->getQty().'<br />';
//            echo 'Price: '.$item->getPrice().'<br />';
//            echo "<br />";

            $this->RuleFactory->create();
            $listRules = $this->RuleFactory->create()->getData();
            foreach ($listRules as $rule) {
                if ($item->getSku() == $rule['products']) {
                    echo 'true';
                }
            }

        }
//        if ($this->_session->isLoggedIn()) {
//            $customerGroupId = $this->_session->getCustomerGroupId();
//            echo $customerGroupId;
//        }
        echo "Lấy dữ liệu từ bảng ";
        $this->RuleFactory->create();
        $listRules = $this->RuleFactory->create()->getData();

        echo '<pre>';
        print_r($listRules);
        echo '<pre>';


    }
}
