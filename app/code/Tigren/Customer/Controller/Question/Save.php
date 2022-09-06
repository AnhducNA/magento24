<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Controller\Question;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Tigren\Customer\Model\QuestionFactory;

class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var QuestionFactory
     */
    protected $_questionFactory;
    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * @param  Context  $context
     * @param  PageFactory  $pageFactory
     * @param  QuestionFactory  $questionFactory
     * @param  Session  $customerSession
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        QuestionFactory $questionFactory,
        Session $customerSession,
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_questionFactory = $questionFactory;
        $this->_customerSession = $customerSession;

        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws Exception
     */
    public function execute()
    {
        $idCustomerLogin = $this->_customerSession->getCustomer()->getId();
        $data = $this->getRequest()->getParams();
        $data['author_id'] = $idCustomerLogin;
//        print_r($data);
        $objectManager = ObjectManager::getInstance();
        $newData = $objectManager->create('Tigren\Customer\Model\Question');
        $newData->setData($data);
        $newData->save();
        $this->messageManager->addSuccess('Add question successfully.');

        return $this->resultRedirectFactory->create()
            ->setPath('tigren_customer/question/questionlisting');
    }
}
