<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Controller\Question;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class QuestionListing extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var Session
     */
    protected $_sesstion;

    /**
     * @param  Context  $context
     * @param  PageFactory  $pageFactory
     * @param  Session  $session
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Session $session,
    ) {
        $this->_sesstion = $session;
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
//        die('aaa');
        if ($this->_sesstion->isLoggedIn()) {
            return $this->_pageFactory->create();
        } else {
            $this->messageManager->addErrorMessage("You have to login to access this page");

            return $this->_redirect('customer/account/login/');
        }
    }
}
