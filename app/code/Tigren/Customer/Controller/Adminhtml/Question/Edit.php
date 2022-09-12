<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Controller\Adminhtml\Question;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package Tigren\Customer\Controller\Adminhtml\Question
 */
class Edit extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $questionId = (int)$this->getRequest()->getParam('id');
        $isExistingQuestion = (bool)$questionId;
        $resultPage = $this->resultPageFactory->create();

        return $resultPage;
    }
}
