<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class AddNew
 *
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule
 */
class AddNew extends Action
{

    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @param  Context  $context
     * @param  PageFactory  $pageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();

        $resultPage->getConfig()->getTitle()
            ->prepend(__('New Rule'));

//        die('aaa');

        return $resultPage;
    }
}
