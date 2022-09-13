<?php

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ObjectManager;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory as RuleCollectionFactory;

class Test extends Action
{
    protected ProductCollectionFactory $_productCollectionFactory;
    protected RuleCollectionFactory $_ruleCollectionFactory;

    public function __construct(
        Context                  $context,
        ProductCollectionFactory $productCollectionFactory,
        RuleCollectionFactory    $ruleCollectionFactory
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_ruleCollectionFactory = $ruleCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
//        die();
        $productCollection = $this->_productCollectionFactory->create()
            ->addFieldToFilter('sku', ['like' => '%' . '24-MB02' . '%'])->setPageSize(1);
//        $product = null;
        $ruleCollection = $this->_ruleCollectionFactory->create();
        foreach ($ruleCollection as $key => $rule) {
            $product = $this->_productCollectionFactory->create()
                ->addFieldToFilter('sku', ['like' => '%' . $rule->getData()['products'] . '%'])->setPageSize(1);
            echo "<pre>";
            print_r($product->getData());
        }


        $productId = "10";

        $objectManager = ObjectManager::getInstance();
        $product = $objectManager->create('Magento\Catalog\Model\Product')->loadByAttribute('sku', '24-MB02');

        echo $product->getSku(); //Get Product Name
    }
}
