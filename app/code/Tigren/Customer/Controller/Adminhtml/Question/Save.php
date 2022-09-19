<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Controller\Adminhtml\Question;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Tigren\Customer\Model\QuestionFactory;

/**
 * Class Save
 * @package Tigren\Customer\Controller\Adminhtml\Question
 */
class Save extends Action
{
    /**
     * @var QuestionFactory
     */
    protected $questionFactory;
    /**
     * @var DateTime
     */
    protected $_date;

    /**
     * @param Context $context
     * @param QuestionFactory $questionFactory
     * @param DateTime $date
     */
    public function __construct(
        Context         $context,
        QuestionFactory $questionFactory,
        DateTime        $date
    ) {
        $this->questionFactory = $questionFactory;
        $this->_date = $date;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|void
     */
    public function execute()
    {
        $date = $this->_date->gmtDate();
        if ($data = $this->getRequest()->getPostValue()) {
            $newData = $data;
            $newData['created_at'] = $date;

            try {
                if (!empty($data['id'])) {
                    $model = $this->questionFactory->create()->load($data['id']);
                    $model->setTitle($newData['title']);
                    $model->setContent($newData['content']);
                    $model->save();
                } else {
                    $model = $this->questionFactory->create();
                    $model->setTitle($newData['title']);
                    $model->setContent($newData['content']);
                    $model->setCreatedAt($newData['created_at']);
//                    $model->addData($newData);
                    $model->save();
                }

                $this->messageManager->addSuccess('Save question successfully.');

                return $this->resultRedirectFactory->create()
                    ->setPath('tigren_customer/question/index');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving the rule data. Please review the error log.')
                );
            }
        }
    }
}
