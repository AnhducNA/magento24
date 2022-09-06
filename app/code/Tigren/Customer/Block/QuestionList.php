<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Tigren\Customer\Model\QuestionFactory;

/**
 *
 */
class QuestionList extends Template
{
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
     * @param  QuestionFactory  $questionFactory
     * @param  Session  $customerSession
     * @param  array  $data
     */
    public function __construct(
        Context $context,
        QuestionFactory $questionFactory,
        Session $customerSession,
        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->_questionFactory = $questionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array|null
     */
    public function getListQuestionByID()
    {
//        $idCustomerLogin = 2;
        $idCustomerLogin = $this->_customerSession->getCustomer()->getId();
//        echo $idCustomerLogin ? $idCustomerLogin : 0;

        if (!empty($idCustomerLogin)) {
            $listQuestion = $this->_questionFactory->create()->getCollection()
                ->getData();
            $listQuestionByID = [];
            foreach ($listQuestion as $key => $question) {
                if ($idCustomerLogin == $question['author_id']) {
                    $listQuestionByID[$key] = $question;
                }
            }
//            echo "<pre>";
//            print_r($listQuestionByID);
            return $listQuestionByID;
        } else {
            $listQuestion = $this->_questionFactory->create()->getCollection()
                ->getData();
//            echo "<pre>";
//            print_r($listQuestion);
            return $listQuestion;
        }

//        exit();
    }

    /**
     * @return array|null
     */
    public function getQuestionCollection()
    {
        $question = $this->_questionFactory->create();
        $collection = $question->getCollection();
//        echo "<pre>";
//        print_r($collection->getData());
//        exit();

        return $collection->getData();
    }
}
