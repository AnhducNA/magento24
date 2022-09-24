<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Plugin\Magento\Catalog\Model\Product;

use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Http\Context as AuthContext;

/**
 * Class Hidecartbutton
 *
 * @package Tigren\CustomerGroupCatalog\Plugin
 */
class Hidecartbutton
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var AuthContext
     */
    protected $authContext;

    /**
     * @param Session $session
     * @param AuthContext $authContext
     */
    public function __construct(Session $session, AuthContext $authContext)
    {
        $this->customerSession = $session;
        $this->authContext = $authContext;
    }

    /**
     * @param  Product  $product
     *
     * @return array
     */
    public function afterIsSaleable(Product $product, $result)
    {
        // using HTTP context
        if ($this->authContext->getValue(Context::CONTEXT_AUTH)) {
            return $result;
        } else {
            return [];
        }

    }
}
