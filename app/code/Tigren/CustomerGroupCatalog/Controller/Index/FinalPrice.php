<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory;

/**
 * Class FinalPrice
 * @package Tigren\CustomerGroupCatalog\Controller\Index
 */
class FinalPrice extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, CollectionFactory $collectionFactory)
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $totalDiscount = 0;
        $listRules = $this->_collectionFactory->create()->addFieldToFilter('products', ['like'=> '%' . '24-WB04' . '%']);
        foreach ($listRules as $key => $rule) {
            $totalDiscount+=$rule['discount_amount'];
        }
        echo "<pre>";
        echo $totalDiscount;
    }
}
