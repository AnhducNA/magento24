<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Question
 * @package Tigren\Question\Model
 */
class Question extends AbstractModel implements IdentityInterface
{
    /**
     * @var string
     */
    const CACHE_TAG = 'tigren_customer_question';

    /**
     * @var string
     */
    protected $_cacheTag = 'tigren_customer_question';

    /**
     * @var string
     */
    protected $_eventPrefix = 'tigren_customer_question';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\Customer\Model\ResourceModel\Question');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
