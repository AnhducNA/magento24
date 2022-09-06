<?php

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule\CollectionFactory;

class GetDatabase extends Action
{
    protected $PageFactory;
    protected $RuleFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $ruleFactory,
    ) {
        parent::__construct($context);
        $this->PageFactory = $pageFactory;
        $this->RuleFactory = $ruleFactory;
    }

    public function execute()
    {
        echo "Lấy dữ liệu từ bảng ";
        $this->RuleFactory->create();
        $collection = $this->RuleFactory->create()->getData();

        echo '<pre>';
        print_r($collection);
        echo '<pre>';
    }
}
