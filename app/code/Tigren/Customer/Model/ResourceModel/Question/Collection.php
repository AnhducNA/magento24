<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Model\ResourceModel\Question;

/**
 *
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'question_id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'tigren_customer_question_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'question_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Tigren\Customer\Model\Question',
            'Tigren\Customer\Model\ResourceModel\Question'
        );
    }
}
