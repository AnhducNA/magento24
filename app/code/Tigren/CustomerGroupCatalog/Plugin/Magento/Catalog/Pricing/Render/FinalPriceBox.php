<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Plugin\Magento\Catalog\Pricing\Render;

use Magento\Customer\Model\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Http\Context as AuthContext;

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
     * @var AuthContext
     */
    private $authContext;

    /**
     * @param  Session  $customerSession
     */
    public function __construct(
        Session $customerSession,
        AuthContext $authContext
    ) {
        $this->customerSession = $customerSession;
        $this->authContext = $authContext;
    }

    /**
     * @param $subject
     * @param  callable  $proceed
     *
     * @return string
     */
    public function aroundtoHtml($subject, callable $proceed)
    {

//         by using Session model
//        if ($this->customerSession->isLoggedIn()) {
//            return $proceed();
//        } else {
//            return 'You need login to see price.';
//        }

        // using HTTP context
        if ($this->authContext->getValue(Context::CONTEXT_AUTH)) {
            return $proceed();
        } else {
            return 'You need login to see price.';
        }
    }
}
