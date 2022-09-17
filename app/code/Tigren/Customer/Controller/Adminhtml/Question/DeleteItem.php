<?php

namespace Tigren\Customer\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use PHPUnit\Exception;
use Tigren\Customer\Model\QuestionFactory;

class DeleteItem extends Action
{
    protected $_pageFactory;
    protected $_questionFactory;

    public function __construct(
        Context         $context,
        PageFactory     $pageFactory,
        QuestionFactory $questionFactory,
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_questionFactory = $questionFactory;

        return parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = $this->getRequest()->getParams();
            if ($data) {
                $model = $this->_questionFactory->create()
                    ->load($data['id']);
                $model->delete();
                $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(
                $e,
                __("We can't delete record, Please try again.")
            );
        }

        return $this->resultRedirectFactory->create()
            ->setPath('tigren_customer/question/index');
    }
}
