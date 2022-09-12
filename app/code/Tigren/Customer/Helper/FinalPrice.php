<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory;

/**
 * Class FinalPrice
 * @package Tigren\CustomerGroupCatalog\Helper
 */
class FinalPrice extends AbstractHelper
{
    protected $_collectionFactory;

    public function __construct(
        Context           $context,
        CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return int
     */
    public function discountByProducts($product)
    {
        $ruleCollection = $this->_collectionFactory->create()->addFieldToFilter('products', ['like' => '%' . $product . '%']);
        $rule = $ruleCollection->setPageSize(1)->getFirstItem();
        $discountAmount = $rule->getDiscountAmount();
        return $discountAmount;
    }
}
