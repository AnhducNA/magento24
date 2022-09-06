<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Edit extends Action
{
    protected $_pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }

//        $idQuestion = $this->getRequest()->getParams();
//        print_r($idQuestion['id']);

    public function execute()
    {
//        die();
//        $idQuestion = $this->getRequest()->getParams();
//        print_r($idQuestion['id']);
        $resultPage = $this->_pageFactory->create();

        $resultPage->getConfig()->getTitle()
            ->prepend(__('Edit Rule'));

        return $resultPage;

    }
}
