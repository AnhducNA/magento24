<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Plugin\Magento\Catalog\Pricing\Render;

use Magento\Customer\Model\Session;

/**
 * Class FinalPriceBox
 *
 * @package Tigren\CustomerGroupCatalog\Plugin\Magento\Catalog\Pricing\Render
 */
class FinalPriceBox
{
    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @param  Session  $customerSession
     */
    public function __construct(Session $customerSession)
    {
        $this->customerSession = $customerSession;
    }

    /**
     * @param $subject
     * @param  callable  $proceed
     *
     * @return string
     */
    public function aroundtoHtml($subject, callable $proceed)
    {
        //Check login
        if ($this->customerSession->isLoggedIn()) {
            return $proceed();
        } else {
            return 'You need login to see price.';
        }
    }
}
