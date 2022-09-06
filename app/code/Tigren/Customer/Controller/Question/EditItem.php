<?php

namespace Tigren\Customer\Controller\Question;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Result\PageFactory;
use Magento\Setup\Exception;
use Tigren\Customer\Model\QuestionFactory;


class EditItem extends Action
{
    protected $_pageFactory;
    protected $_questionFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        QuestionFactory $questionFactory,
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_questionFactory = $questionFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        try {
//            echo 'Anh Duc';
            $data = $this->getRequest()->getParams();
            echo "<pre>";
            print_r($data);
            if (!empty($data)) {
                $updateData = $this->_questionFactory->create()
                    ->load($data['id']);
//                $updateData->setEntityId($data['id']);
                $updateData->setTitle($data['title']);
                $updateData->setContent($data['content']);
                $updateData->setAuthorId($data['author_id']);
                $updateData->save();

                $this->messageManager->addSuccessMessage('Update question successfully.');
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(
                $e,
                __("We can't update record, Please try again.")
            );
        }

        return $this->_redirect('tigren_customer/question/questionlisting');

    }
}
