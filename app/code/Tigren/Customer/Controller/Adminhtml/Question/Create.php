<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 *
 */
class Create extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @param  Context  $context
     * @param  PageFactory  $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        // TODO: Implement execute() method.
//        die('aaa');
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()
            ->prepend(__('Tigren Customer Create New Question'));

//        exit();
        return $resultPage;
    }
}
