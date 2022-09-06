<?php

namespace Tigren\Customer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class QuestionEdit extends Template
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    public function returnIdQuestion()
    {
        $idQuestion = $this->getRequest()->getParams();

        return $idQuestion['id'];
    }
}
