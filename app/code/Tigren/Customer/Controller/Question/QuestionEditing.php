<?php

namespace Tigren\Customer\Controller\Question;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class QuestionEditing extends Action
{
    protected $_pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }

//        $idQuestion = $this->getRequest()->getParams();
//        print_r($idQuestion['id']);

    public function execute()
    {
//        $idQuestion = $this->getRequest()->getParams();
//        print_r($idQuestion['id']);

        return $this->_pageFactory->create();
    }
}
