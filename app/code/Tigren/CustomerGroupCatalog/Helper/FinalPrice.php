<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Helper;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory as RuleCollectionFactory;

/**
 * Class FinalPrice
 * @package Tigren\CustomerGroupCatalog\Helper
 */
class FinalPrice extends AbstractHelper
{
    /**
     * @var ProductCollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * @var Product
     */
    protected $_product;

    /**
     * @var RuleCollectionFactory
     */
    protected RuleCollectionFactory $_collectionFactory;

    /**
     * @param Context $context
     * @param ProductCollectionFactory $productCollectionFactory
     * @param Product $product
     * @param RuleCollectionFactory $ruleCollectionFactory
     */
    public function __construct(
        Context                  $context,
        ProductCollectionFactory $productCollectionFactory,
        Product                  $product,
        RuleCollectionFactory    $ruleCollectionFactory
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_product = $product;
        $this->_collectionFactory = $ruleCollectionFactory;
        parent::__construct($context);
    }

    /**
     * @param $productId
     * @return int
     */
    public function discountByProductID($productId): int
    {
        // get sku by id
        $product = $this->_product->load($productId)->getSku();
        $ruleCollection = $this->_collectionFactory->create()->addFieldToFilter('products', ['like' => '%' . $product . '%']);
        $rule = $ruleCollection->getFirstItem();
        $discountAmount = $rule->getDiscountAmount();

        return (int)$discountAmount;
    }

    /**
     * @param $productId
     * @return int
     */
    public function priceByProductID($productId)
    {
        $price = $this->_product->load($productId)->getPrice();
        return (int)$price;
    }
}
