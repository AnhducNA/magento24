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
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Tigren\Customer\Model\QuestionFactory;
use Tigren\Customer\Model\ResourceModel\Question\CollectionFactory;

class MassDelete extends Action
{
    protected CollectionFactory $collectionFactory;

    protected Filter $filter;
    protected QuestionFactory $questionFactory;

    public function __construct(
        Context           $context,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        QuestionFactory   $questionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->questionFactory = $questionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach ($collection as $question) {
                echo "<pre>";
                print_r($question->getData());
                $this->questionFactory->create()->load($question['entity_id'])->delete();
            }
            $this->messageManager->addSuccess(__('A total of %1 blog(s) have been deleted.', $count));
        } catch (Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('tigren_customer/question/index');
    }

}
