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
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\Result\PageFactory;
use Tigren\Customer\Model\QuestionFactory;


/**
 * Class Save
 * @package Tigren\Customer\Controller\Question
 */
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
     * @var DateTime
     */
    protected $_date;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param QuestionFactory $questionFactory
     * @param Session $customerSession
     * @param DateTime $date
     */
    public function __construct(
        Context         $context,
        PageFactory     $pageFactory,
        QuestionFactory $questionFactory,
        Session         $customerSession,
        DateTime        $date
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_questionFactory = $questionFactory;
        $this->_customerSession = $customerSession;
        $this->_date = $date;
        return parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws Exception
     */
    public function execute()
    {
        $idCustomerLogin = $this->_customerSession->getId() ? $this->_customerSession->getId() : null;
        $date = $this->_date->gmtDate();
        $data = $this->getRequest()->getParams();
        $newData = $data;
        $newData['author_id'] = $idCustomerLogin;
        $newData['created_at'] = $date;

        if (!empty($data['id'])) {
//            Update
            $model = $this->_questionFactory->create()->load($data['id']);
            $model->setTitle($newData['title']);
            $model->setContent($newData['content']);
            $model->setAuthorId($newData['author_id']);
            $model->save();

        } else {
//            Create
            $model = $this->_questionFactory->create();
            $model->setData($newData);
            $model->save();
        }

        $this->messageManager->addSuccess('Save question successfully.');

        return $this->resultRedirectFactory->create()
            ->setPath('tigren_customer/question/index');
    }
}
