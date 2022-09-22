<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedQuestion\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Tigren\Customer\Model\QuestionFactory;
use Tigren\Customer\Model\ResourceModel\Question\Collection;
use Tigren\Customer\Model\ResourceModel\Question\CollectionFactory;

/**
 * Class Index
 * @package Tigren\Question\Block
 */
class Index extends Template
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
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param Context $context
     * @param QuestionFactory $questionFactory
     * @param Session $customerSession
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Context           $context,
        QuestionFactory   $questionFactory,
        Session           $customerSession,
        CollectionFactory $collectionFactory,
        array             $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->_questionFactory = $questionFactory;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        $collectionByID = [];
        if ($this->_customerSession->isLoggedIn()) {
            $idCustomerLogin = $this->_customerSession->getCustomerId();
//            echo $idCustomerLogin ? $idCustomerLogin : null;
            if ($idCustomerLogin) {
                $collection = $this->_collectionFactory->create()->addFieldToFilter('author_id', ['like' => '%' . $idCustomerLogin . '%']);
            }
        } else {
            $collection = $this->_collectionFactory->create();
        }
        return $collection;
    }
}