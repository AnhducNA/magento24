<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Tigren\Customer\Model\Question;
use Tigren\Customer\Model\QuestionFactory;

/**
 * Class Create
 * @package Tigren\Question\Block
 */
class Save extends Template
{
    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;

    /**
     * @param Context $context
     */
    public function __construct(Context $context, QuestionFactory $questionFactory)
    {
        $this->questionFactory = $questionFactory;
        parent::__construct($context);
    }

    /**
     * @return Question
     */
    public function getQuestionUpdate()
    {
        if (!empty($this->returnIdQuestion())) {
            $question = $this->questionFactory->create()->load($this->returnIdQuestion());
            return $question;
        } else {
            return null;
        }
    }

    /**
     * @return mixed|void
     */
    public function returnIdQuestion()
    {
        $idQuestion = $this->getRequest()->getParams();
        if ($idQuestion) {
            return $idQuestion['id'];
        }
    }
}
