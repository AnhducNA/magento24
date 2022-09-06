<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Model;

/**
 *
 */
class Post extends \Magento\Framework\Model\AbstractModel
    implements \Magento\Framework\DataObject\IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = 'tigren_customer_post';

    /**
     * @var string
     */
    protected $_cacheTag = 'tigren_customer_post';

    /**
     * @var string
     */
    protected $_eventPrefix = 'tigren_customer_post';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\Customer\Model\ResourceModel\Post');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
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
