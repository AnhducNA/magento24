<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\HelloWorld\Model\ResourceModel\Topic;

/**
 * Class Collection
 *
 * @package Tigren\HelloWorld\Model\ResourceModel\Topic
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Tigren\HelloWorld\Model\Topic',
            'Tigren\HelloWorld\Model\ResourceModel\Topic'
        );
    }
}
