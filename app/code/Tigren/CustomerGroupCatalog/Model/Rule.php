<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Rule
 * @package Tigren\CustomerGroupCatalog\Model
 */
class Rule extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'tigren_customer_groupcatalog_rule';
    /**
     * @var string
     */
    protected $_cacheTag = 'tigren_customer_groupcatalog_rule';

    /**
     * @var string
     */
    protected $_eventPrefix = 'tigren_customer_groupcatalog_rule';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\CustomerGroupCatalog\Model\ResourceModel\Rule');
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
