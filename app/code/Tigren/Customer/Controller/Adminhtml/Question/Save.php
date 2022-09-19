<?php

namespace Tigren\Customer\Controller\Adminhtml\Question;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Tigren\Customer\Model\QuestionFactory;

class Save extends Action
{
    protected $questionFactory;
    protected $_date;

    public function __construct(Context $context, QuestionFactory $questionFactory, DateTime $date)
    {
        $this->questionFactory = $questionFactory;
        $this->_date = $date;
        parent::__construct($context);
    }

    public function execute()
    {
//        die();
        $date = $this->_date->gmtDate();
        if ($data = $this->getRequest()->getPostValue()) {
            $newData = $data;
            $newData['created_at'] = $date;

            try {
                if (!empty($data['id'])) {
//            Update
                    $model = $this->questionFactory->create()->load($data['id']);
                    $model->setTitle($newData['title']);
                    $model->setContent($newData['content']);
                    $model->save();

                } else {
//            Create
                    $model = $this->questionFactory->create();
                    $model->setData($newData);
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
